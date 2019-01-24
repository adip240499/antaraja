<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Driver';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'tanggal',
                'nama',
                'email:email',
                // 'no_sim',
                //'no_ktp',
                //'pendidikan',
                //'jenis_kelamin',
                //'status',
                //'usia',
                //'no_rek_mandiri',
                'alamat_tinggal',
                //'alamat_ktp',
                //'merk_motor',
                'pekerjaan',
                //'nopol_kendaraan',
                //'files',
                //'ojol',
                //'berkas',
                [
                  'attribute' => 'status',
                  'options' => [
                      'style' => 'width: 90px',
                  ],
                  'format'    => 'raw',
                  'filter'    => $searchModel->listBerkas(),
                  'value'     => function ($model)
                  {
                    switch ($model->berkas) {
                      case $model::BERKAS_DITERIMA:
                      $berkas = '<span class="label label-success">'.$model::BERKAS_DITERIMA.'</span>';
                      break;

                      case $model::BERKAS_DITOLAK:
                      $berkas = '<span class="label label-danger">'.$model::BERKAS_DITOLAK.'</span>';
                      break;

                      case $model::BERKAS_PENDING:
                      $berkas = '<span class="label label-warning">'.$model::BERKAS_PENDING.'</span>';
                      break;

                      default:
                      $berkas = '<span class="label label-danger">'.$model::BERKAS_DELETED.'</span>';
                      break;
                    }

                    return $berkas;
                  },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'options' => [
                        'style' => 'width: 40px',
                    ],
                    'header'   => 'Files',
                    'template' => '{files}',
                    'buttons' => [
                        'files' => function ($url, $model) {
                            if ($model->hasFiles($model->id)) {
                                return Html::a('<i class="fa fa-search-plus"></i>',
                                    ['view-files', 'id' => $model->id],
                                    [
                                        'title' => 'Lihat Berkas',
                                        'class' => 'btn btn-xs btn-primary',
                                    ]
                                );
                            }
                            elseif (!$model->hasFiles($model->id)) {
                                return Html::a('<i class="fa fa-upload"></i>',
                                    ['files', 'id' => $model->id],
                                    [
                                        'title' => 'Unggah Berkas',
                                        'class' => 'btn btn-xs btn-warning',
                                    ]
                                );
                            }
                            // if ($model->isTolak($model->id)) {
                            //
                            //     return '<span class="label label-danger">Status Ditolak</span>';
                            // }
                            //
                            // return '<span class="label label-warning">Status Pending</span>';
                        },
                    ],
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>