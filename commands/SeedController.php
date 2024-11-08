<?php

namespace app\commands;

use app\models\Offer;
use yii\console\Controller;
use Yii;

class SeedController extends Controller
{
  /* Сид для заполнения таблицы offers
   * Для применения использовать: php yii seed/offers
   */
  public function actionOffers()
  {
    $seeder = new \tebazil\yii2seeder\Seeder();
    $generator = $seeder->getGeneratorConfigurator();
    $faker = $generator->getFakerConfigurator();

    $seeder->table('offers')->columns([
      'id',
      'offer_name' => $faker->name,
      'email' => $faker->unique()->email,
      'phone' => $faker->phoneNumber,
    ])->rowQuantity(30);

    $seeder->refill();
  }
}
