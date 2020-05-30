<?php

  $error = '';
switch ($_GET['error']) {
  case 'EmptyFields':
    $error = 'Please fill the empty field!';
    break;
  case 'NoEntry':
    $error = "There's No such User";
    break;
  case 'InvalidDetails':
    $error = 'Please fill the details correctly!';
    break;
  case 'InvalidName':
    $error = 'Your Name Must Contains Only Alphabets and Numbers.';
    break;    
  case 'InvalidEmail':
    $error = 'Entered Email is Invalid.';
    break;
  case 'InvalidPassword':
    $error = 'Your Password Must Contains One Alphabet(upperCase & LowerCase each) and a Number and Special Characte';
    break;    
  case 'shortPassword':
    $error = 'Your Password Must Contains at least 8 Characters';
    break;  
  case 'longPassword':
    $error = 'Your Password Must Contains maximum 15 Characters';
    break;    
  case 'WrongPassword':
    $error = 'You Entered Wrong password';
    break;    
  case 'PasswordNotMatch':
    $error = 'Confirm Password & Password fields must Match';
    break;
  case 'SqlError':
    $error = 'There were some issues with server please try to fill the form again!';
    break;    
  case 'EmailTaken':
    $error = 'Entered Email is Already Taken';
    break;   
  default:
    break;
}

