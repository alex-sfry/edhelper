<?php

namespace app\modules\admin\controllers;

use app\models\Economies;
use app\models\forms\SupplyDemandForm;
use app\models\SupplyDemandSearch;
use app\models\SupplyDemand;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UnauthorizedHttpException;

/**
 * SupplyDemandController implements the CRUD actions for SupplyDemand model.
 */
class SupplyDemandController extends Controller
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
        $form_model = new SupplyDemandForm();
        $model = new SupplyDemand();
        $economies = Economies::find()->economiesList();

        if ($form_model->load($this->request->post()) && $form_model->validate()) {
            // d($this->request->post(), false);
            // d($form_model);

            foreach ($form_model->eco_ids as $item) {
                $model->load($this->request->post('SupplyDemandForm'), '');
                $model->economy_id = $item;
                $model->validate() && $model->save(false);
            }

            return $this->redirect('create', [
                'form_model' => $form_model,
                'model' => $model,
                'economies' => $economies,
                'success' => true
            ]);
        }

        return $this->render('create', [
            'form_model' => $form_model,
            'model' => $model,
            'economies' => $economies,
            'success' => null
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

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $economies = Economies::find()->economiesList();

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
}
