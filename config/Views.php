<?php
/*
 * Views Configuration
 * 
 * This class contains all view paths used in the application.
 * Usage: $this->view(Views::HOME, $data);
 * 
 * Benefits:
 * - Autocomplete support in IDE
 * - Prevents typos in view paths
 * - Easy to maintain and refactor
 * - Organized by section
 */

class Views {
  // ==================== PAGES ====================
  const HOME = 'pages/home';
  const ABOUT = 'pages/about';
  const CONTACT = 'pages/contact';
  
  // ==================== AUTH ====================
  const LOGIN = 'auth/login';
  const SIGNUP = 'auth/signup';
  const FORGOT_PASSWORD = 'auth/forgot_password';
  const RESET_PASSWORD = 'auth/reset_password';
  
  // ==================== STUDENTS ====================
  const STUDENT_DASHBOARD = 'students/dashboard';
  const STUDENT_PROFILE = 'students/profile';
  const STUDENT_COURSES = 'students/courses';
  const STUDENT_GRADES = 'students/grades';
  
  // ==================== LAYOUTS ====================
  const SUCCESS_SIGNUP = 'layouts/success_signup';
  const ERROR_PAGE = 'layouts/error';
  
  // ==================== ERRORS ====================
  const ERROR_404 = 'errors/404';
  const ERROR_500 = 'errors/500';
  const ERROR_403 = 'errors/403';
}