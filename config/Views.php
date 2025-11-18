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
  const BROWSE_ITEMS = '/pages/browse_items';
  const ADD_ITEM = '/pages/add-item';
  const TERMS_AND_CONDITIONS = '/pages/terms-and-conditions';
  const VIEW_ITEM_DETAILS = '/pages/view-item';
  const EDIT_ITEM = '/pages/edit-item';
  const CHECKOUT_PAGE = '/pages/checkout';
  const PROCESS_BOOKING = '/pages/process-booking';
  const ADMIN_DASHBOARD = '/pages/admin-dashboard';
  
  // ==================== AUTH ====================
  const LOGIN = 'auth/login';
  const SIGNUP = 'auth/signup';
  const FORGOT_PASSWORD = 'auth/forgot_password';
  const RESET_PASSWORD = 'auth/reset_password';
  
  // ==================== USERS ====================
  const USER_DASHBOARD = 'pages/user_dashboard';
  const USER_PROFILE = 'pages/profile';

  // ==================== LAYOUTS ====================
  const SUCCESS_SIGNUP = 'layouts/success_signup';
  const ERROR_PAGE = 'layouts/error';
  
  // ==================== ERRORS ====================
  const ERROR_404 = 'errors/404';
  const ERROR_500 = 'errors/500';
  const ERROR_403 = 'errors/403';
}