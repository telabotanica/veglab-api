<?php

namespace App\Elastica\Transformer;  

use App\Entity\Table;
use App\Entity\OccurrenceValidation;
use DateTime;
use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;
use App\DBAL\FieldDataTypeEnumType;
use stdClass;

/**
* Transforms <code>Table</code> entity instances into elastica 
* <code>Document</code> instances.
*
* @package App\Elastica\Transformer
*/
class TableToElasticaTransformer implements ModelToElasticaTransformerInterface
{
  
  /**
  * @inheritdoc
  */
  public function transform($table, array $fields)
  {
    return new Document($table->getId(), $this->buildData($table));
  }

  protected function buildData($table)
  {
    $data = [];
    $tableValidations = [];

    // VL USER
    $u = $table->getUser();
    $vlUser = (object)array(
        'id' => $u->getId(),
        'ssoId' => $u->getSsoId(),
        'firstName' => $u->getFirstName(),
        'lastName' => $u->getLastName(),
        'username' => $u->getUsername(),
        'email' => $u->getEmail()
    );

    // VL Table Validation
    foreach($table->getValidations() as $validation) {
      $v = array(
          'id' => $validation->getId(),
          'validatedBy' => $validation->getValidatedBy(),
          'validatedAt' => $validation->getValidatedAt() ? $validation->getValidatedAt()->format('Y-m-d H:i:s') : null,
          'user' => $vlUser,
          'updatedBy' => $validation->getUpdatedBy(),
          'updatedAt' => $validation->getUpdatedAt() ? $validation->getUpdatedAt()->format('Y-m-d H:i:s') : null,
          'repository' => $validation->getRepository(),
          'repositoryIdNomen' => $validation->getRepositoryIdNomen(),
          'repositoryIdTaxo' => $validation->getRepositoryIdTaxo(),
          'inputName' => $validation->getInputName(),
          'validatedName' => $validation->getValidatedName(),
          'validName' => $validation->getValidName(),
          'userIdValidation' => $validation->getUserIdValidation()
      );
      $tableValidations[] = $v;
    }

    $data['id']               = $table->getId();
    $data['isDiagnosis']      = $table->getIsDiagnosis();

    $data['title']            = $table->getTitle();
    $data['description']      = $table->getDescription();

    $data['hasPdf']           = (null !== $table->getPdf()) ? true : false;
    $data['pdfContentUrl']    = (null !== $table->getPdf()) ? $table->getPdf()->getContentUrl() : null;

    $data['userId']           = $table->getUserId();
    $date['userPseudo']       = $table->getUserPseudo();
    $data['user']             = $vlUser;

    $data['createdBy']        = $table->getCreatedBy();
    $data['createdAt']        = $this->getFormattedDate($table->getCreatedAt());
    $data['updatedBy']        = $table->getUpdatedBy();
    $data['updatedAt']        = $this->getFormattedDate($table->getUpdatedAt());

    $data['validations']      = $tableValidations;
    // $data['syeValidations']   = $this->getSyeValidations($table->getSye());
    // $data['occurrencesValidations']  = $this->getSyeOccurrencesValidations($table->getSye());
    $data['rowsValidations']  = $this->getRowsValidations($table);

    $data['tableName']        = (null !== $table->getValidations()[0]) ? $table->getValidations()[0]->getValidatedName() : '';
    $data['occurrencesNames'] = $this->getOccurrencesNames($table);

    $data['syeCount']         = count($table->getSye());
    $data['rowsCount']        = $this->getRowsCount($table);
    $data['occurrencesCount'] = $this->getOccurrencesCount($table);

    $data['allValidations']   = $this->getValidations($table);

    $data['vlBiblioSource']   = $table->getVlBiblioSource() ? $table->getVlBiblioSource()->getId().'~'.$table->getVlBiblioSource()->getTitle() : null;

    $data['preview']          = $this->getTablePreview($table);

    $data['vlWorkspace']      = $table->getVlWorkspace();

    return $data;
  }

  private function getFormattedDate(?\DateTimeInterface $date): ?string
  {
    return  (null !== $date) ? $date->format('Y-m-d H:i:s') : null;
  }

  private function getTableValidation(?OccurrenceValidation $validation): ?string
  {
    if (null === $validation) return '';
    return $validation->getRepository() . '~' . $validation->getRepositoryIdTaxo();
  }

  private function getSyeValidations($syes): ?string
  {
    $flatValidations = '';

    if (null === $syes) return '';

    foreach ($syes as $sye) {
      if (null !== $sye->getValidations()) {
        foreach($sye->getValidations() as $syeValidation) {
          $i = 0;
          $flatValidation = $syeValidation->getRepository() . '~' . $syeValidation->getRepositoryIdTaxo();
          if ($i === 0) { $flatValidations = $flatValidation; } elseif ($i > 0) { $flatValidations = $flatValidations . ' ' . $flatValidation; }
          $i++;
        }
      }
    }

    return $flatValidations;
  }

  private function getSyeOccurrencesValidations($syes): ?string
  {
    $flatValidations = '';

    if (null === $syes) return '';

    foreach ($syes as $sye) {
      $i = 0;
      $flatValidation = $this->getOccurrencesValidations($sye->getOccurrences());
      if ($i === 0) { $flatValidations = $flatValidation; } elseif ($i > 0) { $flatValidations = $flatValidations . ' ' . $flatValidation; }
      $i++;
    }

    return $flatValidations;
  }

  private function getOccurrencesValidations($occurrences): ?string
  {
    $flatValidations = '';

    if (null === $occurrences) return '';

    foreach ($occurrences as $occ) {
      $occValidations = $occ->getValidations();
      if (null !== $occValidations) {
        foreach ($occValidations as $occValidation) {
          $i = 0;
          $flatValidation = $occValidation->getRepository() . '~' . $occValidation->getRepositoryIdTaxo();
          $flatValidations .= $flatValidation . ' ';
          $i++;
        }
      }
    }

    return $flatValidations;
  }

  private function getRowsValidations($table): ?string {
    $flatValidations = '';

    if (null === $table) return '';

    $tableRowDef = $table->getRowsDefinition();

    if (null === $tableRowDef) return '';

    $i = 0;
    foreach ($tableRowDef as $rowDef) {
      if ('data' === $rowDef->getType()) {
        $flatValidation = $rowDef->getRepository() . '~' . $rowDef->getRepositoryIdTaxo();
        if ($i === 0) { $flatValidations = $flatValidation; } elseif ($i > 0) { $flatValidations = $flatValidations . ' ' . $flatValidation; }
        $i++;
      }
    }

    return $flatValidations;
  }

  private function getTablePreview($table) {
    $rowsDef = $table->getRowsDefinition();
    $syntheticCol = $table->getSyntheticColumn()->getItems();

    $rows = [];

    $i = 0;
    $j = 0;
    foreach ($rowsDef as $rowDef) {
      if ($rowDef->getType() === 'group') {
        $rows[$i] = $rowDef->getDisplayName();
      } elseif ($rowDef->getType() === 'data') {
        $rows[$i] = $rowDef->getDisplayName();
        try {
          $rows[$i] .= '~' . $syntheticCol[$j]->getCoef();
        } catch (\Throwable $th) {
          //throw $th;
        }
        
        $j++;
      }
      $i++;
    }

    return $rows;
  }

  private function getValidations($_table) {
    $validations = new stdClass();

    $tableId = $_table->getId();
    $tableValidations = $_table->getValidations();

    $table = new stdClass();
    $table->id = $tableId;
    $table->validations = $tableValidations;

    $syes = array();
    foreach ($_table->getSye() as $sye) {
      $syeId          = $sye->getId();
      $syeValidations = $sye->getValidations();
      $syeReleves     = $sye->getOccurrences();

      $releves = array();

      foreach ($syeReleves as $syeReleve) {
        $releve = new stdClass();
        $releve->id = $syeReleve->getId();
        $releve->validations = $syeReleve->getValidations();
        $releves[] = $releve;
      }

      $sye = new stdClass();
      $sye->id = $syeId;
      $sye->validations = $syeValidations;
      $sye->releves = $releves;

      $syes[] = $sye;
    }

    $validations->table = $table;
    $validations->syes  = $syes;

    return $validations; // json_encode($validations);
  }

  private function getOccurrencesCount($table): ?int {
    if (null === $table) return 0;
    $syes = $table->getSye();
    if (null === $syes) return 0;

    $count = 0;
    foreach ($syes as $sye) {
      $count += count($sye->getOccurrences());
    }

    return $count;
  }

  private function getRowsCount($table): ?int {
    if (null === $table) return 0;
    $rowsDef = $table->getRowsDefinition();
    if (null === $rowsDef) return 0;

    $count = 0;
    foreach ($rowsDef as $rowDef) {
      if ($rowDef->getType() === 'data') $count++;
    }
    
    return $count;
  }

  private function getOccurrencesNames($table) {
    if (null === $table) return [];
    $syes = $table->getSye();
    if (null === $syes) return [];

    $v = array();
    foreach ($syes as $sye) {
      $occurrences = $sye->getOccurrences();
      foreach ($occurrences as $occ) {
        $validation = $occ->getValidations()[0];
        if (null !== $validation) $v[] = $validation->getValidatedName();
      }
    }

    return $v;
  }
}