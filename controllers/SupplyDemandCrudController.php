<?php

namespace app\controllers;

use app\models\Economies;
use app\models\forms\SupplyDemandCreateForm;
use app\models\SupplyDemand;
use app\models\search\SupplyDemandSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UnauthorizedHttpException;

/**
 * SupplyDemandCrudController implements the CRUD actions for SupplyDemand model.
 */
class SupplyDemandCrudController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                if (!Yii::$app->user->isGuest && Yii::$app->user->id == 1) {
                                    return true;
                                }

                                throw new UnauthorizedHttpException();
                            }
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all SupplyDemand models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SupplyDemandSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $economies = ArrayHelper::map($this->economies(), 'economy_name', 'economy_name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'economies' => $economies
        ]);
    }

    /**
     * Displays a single SupplyDemand model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SupplyDemand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form_model = new SupplyDemandCreateForm();
        $existing_ids = [];

        if ($this->request->isPost) {
            if ($form_model->load($this->request->post()) && $form_model->validate()) {
                $post = $this->request->post('SupplyDemandCreateForm');

                foreach ($post['economy_ids'] as $item) {
                    $exist = SupplyDemand::findOne(['commodity' => $post['commodity'], 'economy_id' => $item]);

                    if ($exist) {
                        array_push($existing_ids, $exist->getPrimaryKey());
                        continue;
                    }

                    $model = new SupplyDemand();
                    $model->setAttributes([
                        'commodity' => $post['commodity'],
                        'economy_id' => (int)$item,
                        'import_export' =>  $post['import_export']
                    ]);

                    $model->save();
                }

                empty($existing_ids) && $this->redirect(['supply-demand-crud/index']);
            }
        }

        return $this->render('create', [
            'model' => $form_model,
            'exiting_ids' => $existing_ids
        ]);
    }

    /**
     * Updates an existing SupplyDemand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $economies = ArrayHelper::map($this->economies(), 'id', 'economy_name');

        return $this->render('update', [
            'model' => $model,
            'economies' => $economies
        ]);
    }

    /**
     * Deletes an existing SupplyDemand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SupplyDemand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SupplyDemand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SupplyDemand::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return array
     */
    protected function economies()
    {
        return Economies::find()
            ->select(['id', 'economy_name'])
            ->where(['not in', 'id', [16, 17, 18]])
            ->asArray()
            ->all();
    }
}
