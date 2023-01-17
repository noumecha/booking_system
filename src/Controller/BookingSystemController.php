<?php

namespace Drupal\booking_system\Controller;

use Drupal\booking_system\Service\BookingManagerService;
use Stephane888\DrupalUtility\HttpResponse;
use Stephane888\Debug\ExceptionExtractMessage;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Returns responses for booking_system routes.
 */
class BookingSystemController extends ControllerBase
{

  protected  $manager;

  public function __construct(BookingManagerService $manager)
  {
    $this->manager = $manager;
  }


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static($container->get('booking_system.manager'));
  }


  /**
   * Builds the response to showing the Vue-js app
   */
  public function build()
  {
    $build['content'] = [
      '#type' => 'html_tag',
      '#tag' => 'section',
      "#attributes" => [
        'id' => 'app',
        'class' => [
          'm-5',
          'p-5'
        ]
      ]
    ];
    $build['content']['#attached']['library'][] = 'booking_system/booking_system_app';
    //dump($build);
    return $build;
  }

  /**
   *
   * Give the days to disable
   *
   */
  public function dates()
  {
    try {

      $data = $this->manager->generateDates();
      return HttpResponse::response($data);
    } catch (\Exception $e) {
      $errors = ExceptionExtractMessage::errorAll($e);
      $this->getLogger('boobooking_system.settingsking_system')->critical(ExceptionExtractMessage::errorAllToString($e));
      return HttpResponse::response($errors, 400, $e->getMessage());
    }
  }

  /**
   *
   * Give the differents schedule of a day
   *
   */
  public function schedule($day)
  {
      $data = $this->manager->generateSchdules($day);
      if (isset($data["error"])) {
        return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
      }

      return new JsonResponse($data, Response::HTTP_OK);
  }


  /**
   * @inheritdoc
   */
  public function default()
  {
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('Starting default page for testing purpose!'),
    ];
    return $build;
  }
}
