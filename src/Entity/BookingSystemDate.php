<?php

namespace Drupal\booking_system\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EditorialContentEntityBase;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Booking system date entity.
 *
 * Cette entité est utiliser pour stocker les informations suivantes:
 *  + heure_de_debut
 *  + heure_de_fin
 *  + intervalle de temps qui sépare les différentes pages
 *
 * @ingroup booking_system
 *
 * @ContentEntityType(
 *   id = "booking_system_date",
 *   label = @Translation("Booking system date"),
 *   handlers = {
 *     "storage" = "Drupal\booking_system\BookingSystemDateStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\booking_system\BookingSystemDateListBuilder",
 *     "views_data" = "Drupal\booking_system\Entity\BookingSystemDateViewsData",
 *     "translation" = "Drupal\booking_system\BookingSystemDateTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\booking_system\Form\BookingSystemDateForm",
 *       "add" = "Drupal\booking_system\Form\BookingSystemDateForm",
 *       "edit" = "Drupal\booking_system\Form\BookingSystemDateForm",
 *       "delete" = "Drupal\booking_system\Form\BookingSystemDateDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\booking_system\BookingSystemDateHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\booking_system\BookingSystemDateAccessControlHandler",
 *   },
 *   base_table = "booking_system_date",
 *   data_table = "booking_system_date_field_data",
 *   revision_table = "booking_system_date_revision",
 *   revision_data_table = "booking_system_date_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer booking system date entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
*   revision_metadata_keys = {
*     "revision_user" = "revision_uid",
*     "revision_created" = "revision_timestamp",
*     "revision_log_message" = "revision_log"
*   },
 *   links = {
 *     "canonical" = "/admin/structure/booking_system_date/{booking_system_date}",
 *     "add-form" = "/admin/structure/booking_system_date/add",
 *     "edit-form" = "/admin/structure/booking_system_date/{booking_system_date}/edit",
 *     "delete-form" = "/admin/structure/booking_system_date/{booking_system_date}/delete",
 *     "version-history" = "/admin/structure/booking_system_date/{booking_system_date}/revisions",
 *     "revision" = "/admin/structure/booking_system_date/{booking_system_date}/revisions/{booking_system_date_revision}/view",
 *     "revision_revert" = "/admin/structure/booking_system_date/{booking_system_date}/revisions/{booking_system_date_revision}/revert",
 *     "revision_delete" = "/admin/structure/booking_system_date/{booking_system_date}/revisions/{booking_system_date_revision}/delete",
 *     "translation_revert" = "/admin/structure/booking_system_date/{booking_system_date}/revisions/{booking_system_date_revision}/revert/{langcode}",
 *     "collection" = "/admin/structure/booking_system_date",
 *   },
 *   field_ui_base_route = "booking_system_date.settings"
 * )
 */
class BookingSystemDate extends EditorialContentEntityBase implements BookingSystemDateInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

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
    // make the booking_system_date owner the revision author.
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
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Booking system date entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Booking system date entity.'))
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
    # date de debut
    $fields['start_date'] = BaseFieldDefinition::create('daterange')
      ->setLabel(t('Date de debut'))
      ->setDescription(t('Définir la date de debut de la plage'))
      ->setSettings(['datetime_type' => 'date',])
      ->setRevisionable(FALSE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'dis_hours_date_time_widget',
        'weight' => 0,
      ]);
    # date de fin
    $fields['end_date'] = BaseFieldDefinition::create('daterange')
      ->setLabel(t('Date de fin'))
      ->setDescription(t('Définir la date de fin de la plage'))
      ->setRevisionable(FALSE)
      ->setSettings(['datetime_type' => 'date',])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'dis_hours_date_time_widget',
        'weight' => 0,
      ]);
    # defining the period : 
    $fields['period'] = BaseFieldDefinition::create('period_type')
    ->setLabel(t('Modifier la Période '))
    ->setDisplayOptions('form', [
      'type' => '',
      'weight' => 0
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE)
    ->setSetting('target_type', 'paragraph')
    ->setSetting('handler', 'default')
    ->setTranslatable(false)
    ->setSetting('allow_duplicate', true);
    # discount
    $fields['discount'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Discount'))
      ->setDescription(t('Modifier la reduction pour la date '))
      ->setSettings([
          'min' => 1,
          'max' => 20
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'number_unformatted',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number_unformatted',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);
    $fields['status']->setDescription(t('A boolean indicating whether the Booking system date is published.'))
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
