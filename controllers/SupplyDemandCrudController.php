<?php

namespace app\controllers;

use app\models\forms\SupplyDemandCreateForm;
use app\models\SupplyDemand;
use app\models\search\SupplyDemandSearch;
use Yii;
use yii\db\IntegrityException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        $status = null;

        if ($this->request->isPost) {
            if ($form_model->load($this->request->post()) && $form_model->validate()) {
                $post = $this->request->post('SupplyDemandCreateForm');

                foreach ($post['economy_ids'] as $item) {
                    $model = new SupplyDemand();
                    $model->setAttributes([
                        'commodity' => ucfirst($post['commodity']),
                        'economy_id' => (int)$item,
                        'import_export' => $post['import_export']
                    ]);

                    try {
                        $model->save();
                    } catch (IntegrityException $e) {
                        $status = $e->getCode() === '23000' ? 'Record already exists.' : null;
                    }
                }
            }
        }

        return $this->render('create', [
            'model' => $form_model,
            'status' => $status
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

        return $this->render('update', [
            'model' => $model,
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
