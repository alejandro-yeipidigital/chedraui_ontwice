<?php

namespace App\Services;

use App\Services\AbstractClasses\StatusAbstract;
use App\Repositories\{UserRepository};

class RegisterServiceClass extends StatusAbstract
{
  public function __construct() {
      $this->userRepository           = new UserRepository;
  }

  /**
   * Validate user's email, if it's correct then store it in DB
   * @param $user_id, $user_response
   * return array
   */
  public function getResponse($language, $user_id, $user_response, $image_url) : array 
  {
      // If email is valid 
      if (filter_var($user_response, FILTER_VALIDATE_EMAIL)) 
      {
        // Get users email
        $user_email = $this->userRepository->findUser($user_id)->email;

        // Verify if user has already set it's email before
        if ($user_email) {
            // Verify email is unique excluding current user
            if (!$this->userRepository->isEmailUniqueUpdate($user_id, $user_response)) {
                return [config('bot_messages.' . $language . '.correo_existente')];
            }
        } else {
            // Verify email is unique among all users
            if (!$this->userRepository->isEmailUnique($user_response)) {
                return [config('bot_messages.' . $language . '.correo_existente')];
            }
        }

        // Store User Email
        $this->userRepository->storeEmail($user_id, $user_response);
        
        // Update User Status
        $this->updateUserStatus($user_id, 6); // Esperando nombre
        
        $messages[] = config('bot_messages.' . $language . '.nombre_solicitar');
        
        return $messages;
                
    }
      
    return [config('bot_messages.' . $language . '.correo_invalido')];
  } 

  /**
   * Validate user's email, if it's correct then store it in DB
   * @param $user_id, $user_response
   * return array
   */
  public function storeName($language, $user_id, $user_response) : array 
  {
    if (!is_string($user_response)) {
        $messages[] = config('bot_messages.' . $language . '.repetir_nombre');
      
        return $messages;      
    }

    // Store User Name
    $this->userRepository->storeName($user_id, $user_response);
    
    // Update User Status
    $this->updateUserStatus($user_id, 7); // Esperando RUT
    
    $messages[] = config('bot_messages.' . $language . '.rut_solicitar');
    
    return $messages;             
  } 

  /**
   * Validate user's email, if it's correct then store it in DB
   * @param $user_id, $user_response
   * return array
   */
  public function storeRut($language, $user_id, $user_response) : array 
  {
    if (!is_string($user_response)) {
        $messages[] = config('bot_messages.' . $language . '.repetir_rut');
      
        return $messages;      
    }

      // Store User Rut
      $this->userRepository->storeRut($user_id, $user_response);
      
      // Update User Status
      $this->updateUserStatus($user_id, 8); // Esperando Telefono
      
      $messages[] = config('bot_messages.' . $language . '.telefono_solicitar');
      
      return $messages;             
  } 

  // /**
  //  * Validate user's email, if it's correct then store it in DB
  //  * @param $user_id, $user_response
  //  * return array
  //  */
  // public function storeMiddleName($language, $user_id, $user_response) : array 
  // {
  //   // Store User Middle Name
  //   $this->userRepository->storeMiddleName($user_id, $user_response);
    
  //   // Update User Status
  //   $this->updateUserStatus($user_id, 8); // Esperando Apellido Materno
    
  //   $messages[] = config('bot_messages.' . $language . '.apellidoM_solicitar');
    
  //   return $messages; 
  // } 

  // /**
  //  * Validate user's email, if it's correct then store it in DB
  //  * @param $user_id, $user_response
  //  * return array
  //  */
  // public function storeLastName($language, $user_id, $user_response) : array 
  // {
  //   // Store User Last Name
  //   $this->userRepository->storeLastName($user_id, $user_response);
    
  //   // Update User Status
  //   $this->updateUserStatus($user_id, 9); // Esperando Teléfono
    
  //   $messages[] = config('bot_messages.' . $language . '.telefono_solicitar');
    
  //   return $messages; 
  // } 

  /**
   * Validate user's email, if it's correct then store it in DB
   * @param $user_id, $user_response
   * return array
   */
  public function storeTelephone($language, $user_id, $user_response) : array 
  {
    // Remove spaces
    $telephone = str_replace(' ', '', $user_response);

    // If telephone is not digits only, then send message
    if (!ctype_digit($telephone)) {
        $messages[] = config('bot_messages.' . $language . '.repetir_telefono');
        
        return $messages;
    }

    // Store User Telephone
    $this->userRepository->storeTelephone($user_id, $telephone);
    
    // Update User Status
    $this->updateUserStatus($user_id, 9); // Esperando Confirmación de Datos
    
    $messages[] = config('bot_messages.' . $language . '.confirmar_datos');
    
    return $messages; 
  } 

  /**
   * Validate user's email, if it's correct then store it in DB
   * @param $user_id, $user_response
   * return array
   */
  public function confirmData($language, $user_id, $user_response) : array 
  {   
      // if user doesn't confirms that the data registered is correct
      if (in_array($user_response, ['si', 'sí', 'sÍ'])) {
        // Set register complete
        $this->userRepository->confirmRegister($user_id);
        
        // Update User Status
        $this->updateUserStatus($user_id, 10); // Esperando Imagen
        
        $messages[] = config('bot_messages.' . $language . '.imagen_requerida');
      } elseif (in_array($user_response, ['no'])) {
        // Update User Status back to 5 Esperando correo
        $this->updateUserStatus($user_id, 5); // Esperando correo

        $messages[] = config('bot_messages.' . $language . '.repetir_registro');
        $messages[] = config('bot_messages.' . $language . '.correo_solicitar');
      } else {
        $messages[] = config('bot_messages.' . $language . '.repetir_confirmar_datos');
      }  
      
      return $messages;
  } 
}