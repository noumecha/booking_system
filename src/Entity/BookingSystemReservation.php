<?php

namespace Drupal\booking_system\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EditorialContentEntityBase;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Booking system reservation entity.
 *
 * @ingroup booking_system
 *
 * @ContentEntityType(
 *   id = "booking_system_reservation",
 *   label = @Translation("Booking system reservation"),
 *   handlers = {
 *     "storage" = "Drupal\booking_system\BookingSystemReservationStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\booking_system\BookingSystemReservationListBuilder",
 *     "views_data" = "Drupal\booking_system\Entity\BookingSystemReservationViewsData",
 *     "translation" = "Drupal\booking_system\BookingSystemReservationTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\booking_system\Form\BookingSystemReservationForm",
 *       "add" = "Drupal\booking_system\Form\BookingSystemReservationForm",
 *       "edit" = "Drupal\booking_system\Form\BookingSystemReservationForm",
 *       "delete" = "Drupal\booking_system\Form\BookingSystemReservationDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\booking_system\BookingSystemReservationHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\booking_system\BookingSystemReservationAccessControlHandler",
 *   },
 *   base_table = "booking_system_reservation",
 *   data_table = "booking_system_reservation_field_data",
 *   revision_table = "booking_system_reservation_revision",
 *   revision_data_table = "booking_system_reservation_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer booking system reservation entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
*   revision_metadata_keys = {
*     "revision_user" = "revision_uid",
*     "revision_created" = "revision_timestamp",
*     "revision_log_message" = "revision_log"
*   },
 *   links = {
 *     "canonical" = "/admin/structure/booking_system_reservation/{booking_system_reservation}",
 *     "add-form" = "/admin/structure/booking_system_reservation/add",
 *     "edit-form" = "/admin/structure/booking_system_reservation/{booking_system_reservation}/edit",
 *     "delete-form" = "/admin/structure/booking_system_reservation/{booking_system_reservation}/delete",
 *     "version-history" = "/admin/structure/booking_system_reservation/{booking_system_reservation}/revisions",
 *     "revision" = "/admin/structure/booking_system_reservation/{booking_system_reservation}/revisions/{booking_system_reservation_revision}/view",
 *     "revision_revert" = "/admin/structure/booking_system_reservation/{booking_system_reservation}/revisions/{booking_system_reservation_revision}/revert",
 *     "revision_delete" = "/admin/structure/booking_system_reservation/{booking_system_reservation}/revisions/{booking_system_reservation_revision}/delete",
 *     "translation_revert" = "/admin/structure/booking_system_reservation/{booking_system_reservation}/revisions/{booking_system_reservation_revision}/revert/{langcode}",
 *     "collection" = "/admin/structure/booking_system_reservation",
 *   },
 *   field_ui_base_route = "booking_system_reservation.settings"
 * )
 */
class BookingSystemReservation extends EditorialContentEntityBase implements BookingSystemReservationInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  protected function urlRouteParameters($rel) {
    $uri_route_parameters = parent::urlRouteParameters($rel);

    if ($rel === 'revision_revert' && $this instanceof RevisionableInterface) {
      $uri_route_parameters[$this->getEntityTypeId() . '_revision'] = $this->getRevisionId();
    }
    elseif ($rel === 'revision_delete' && $this instanceof RevisionableInterface) {
      $uri_route_parameters[$this->getEntityTypeId() . '_revision'] = $this->getRevisionId();
    }

    return $uri_route_parameters;
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
      $translation = $this->getTranslation($langcode);

      // If no owner has been set explicitly, make the anonymous user the owner.
      if (!$translation->getOwner()) {
        $translation->setOwnerId(0);
      }
    }

    // If no revision author has been set explicitly,
    // make the booking_system_reservation owner the revision author.
    if (!$this->getRevisionUser()) {
      $this->setRevisionUserId($this->getOwnerId());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Booking system reservation entity.'))
      ->setRevisionable(TRUE)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status']->setDescription(t('A boolean indicating whether the Booking system reservation is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['revision_translation_affected'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Revision translation affected'))
      ->setDescription(t('Indicates if the last edit of a translation belongs to current revision.'))
      ->setReadOnly(TRUE)
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE);

    return $fields;
  }

}
