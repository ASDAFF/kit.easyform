<?
/**
 * Copyright (c) 2/1/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

// DEFAULT_FIELDS
$MESS['KIT_EASYFORM_FIELD_TITLE'] = 'Your name';
$MESS['KIT_EASYFORM_FIELD_EMAIL'] = 'Your E-mail';
$MESS['KIT_EASYFORM_FIELD_PHONE'] = 'Mobile phone';
$MESS['KIT_EASYFORM_FIELD_MALE'] = 'Your sex';
$MESS['KIT_EASYFORM_FIELD_MALE_VAL_1'] = 'Male';
$MESS['KIT_EASYFORM_FIELD_MALE_VAL_2'] = 'Female';
$MESS['KIT_EASYFORM_FIELD_BUDGET'] = 'Budget';
$MESS['KIT_EASYFORM_FIELD_BUDGET_VAL_1'] = 'up to 50,000 rubles';
$MESS['KIT_EASYFORM_FIELD_BUDGET_VAL_2'] = 'from 50,000 to 200,000 rubles';
$MESS['KIT_EASYFORM_FIELD_CUSTOM'] = 'Services';
$MESS['KIT_EASYFORM_FIELD_CUSTOM_VAL_1'] = 'Service 1';
$MESS['KIT_EASYFORM_FIELD_CUSTOM_VAL_2'] = 'Service 2';
$MESS['KIT_EASYFORM_FIELD_SERVICES'] = 'Service';
$MESS['KIT_EASYFORM_FIELD_SERVICES_VAL_1'] = 'Website development';
$MESS['KIT_EASYFORM_FIELD_SERVICES_VAL_2'] = 'Site Support';
$MESS['KIT_EASYFORM_FIELD_ACCEPT'] = 'Consent to processing data';
$MESS['KIT_EASYFORM_FIELD_ACCEPT_VAL'] = 'I agree to process <a href="#" target="_blank"> personal data </a>';
$MESS['KIT_EASYFORM_FIELD_MESSAGE'] = 'Message';
$MESS['KIT_EASYFORM_FIELD_DOCS'] = 'Document';
$MESS['KIT_EASYFORM_FIELD_HIDDEN'] = 'Hidden Field';

// VISUAL
$MESS['KIT_EASYFORM_UNIQUE_FORM_ID'] = 'Form ID';
$MESS['KIT_EASYFORM_FORM_NAME'] = 'Form name';
$MESS['KIT_EASYFORM_FORM_NAME_DEFAULT'] = 'Feedback Form';
$MESS['KIT_EASYFORM_WIDTH_FORM'] = 'Width of the form';
$MESS['KIT_EASYFORM_DISPLAY_FIELDS'] = 'Fields';
$MESS['KIT_EASYFORM_REQUIRED_FIELDS'] = 'Required fields';
$MESS['KIT_EASYFORM_FIELDS_ORDER'] = 'Location of form fields';
$MESS['KIT_EASYFORM_HIDE_FIELD_NAME'] = 'Hide form field names';
$MESS['KIT_EASYFORM_HIDE_ASTERISK'] = 'Remove colons and asterisks';
$MESS['KIT_EASYFORM_FORM_AUTOCOMPLETE'] = 'AutoComplete form field values';
$MESS['KIT_EASYFORM_FORM_SUBMIT_VALUE'] = 'Button Name';
$MESS['KIT_EASYFORM_FORM_SUBMIT_VALUE_DEFAULT'] = 'Send';

// SUBMIT
$MESS['KIT_EASYFORM_GROUP_SUBMIT'] = 'Send form';
$MESS['KIT_EASYFORM_SEND_AJAX'] = 'Send form using AJAX?';
$MESS['KIT_EASYFORM_SHOW_MODAL'] = 'Show result in modal window';
$MESS['KIT_EASYFORM_FUNCTION_CALLBACKS_SUCCESS'] = 'Function name on successful sending ("_callbacks")';
$MESS['KIT_EASYFORM_OK_MESSAGE'] = 'The message about the successful sending';
$MESS['KIT_EASYFORM_OK_TEXT'] = 'Your message has been sent. We will contact you within 2 hours';
$MESS['KIT_EASYFORM_ERROR_MESSAGE'] = 'Error message';
$MESS['KIT_EASYFORM_ERROR_TEXT'] = 'An error occurred. Message not sent.';
$MESS['KIT_EASYFORM_TITLE_SHOW_MODAL'] = 'Window title';
$MESS['KIT_EASYFORM_DEFAULT_TITLE_SHOW_MODAL'] = 'Thank you!';

// MAIL
$MESS['KIT_EASYFORM_GROUP_MAIL'] = 'Sending settings for messages';
$MESS['KIT_EASYFORM_ENABLE_SEND_MAIL'] = 'Enable sending emails';
$MESS['KIT_EASYFORM_CREATE_SEND_MAIL'] = 'Create a new mail template';
$MESS['KIT_EASYFORM_EMAIL_TEMPLATES'] = 'Letter template';
$MESS['KIT_EASYFORM_REPLACE_FIELD_FROM'] = "Replace the letter \"From\" with the visitor's e-mail address";
$MESS['KIT_EASYFORM_EMAIL_FROM'] = '# EMAIL_FROM #';
$MESS['KIT_EASYFORM_EVEN_EMAIL_TO'] = '# EMAIL_TO #';
$MESS['KIT_EASYFORM_BCC'] = '# EMAIL_BCC #';
$MESS['KIT_EASYFORM_MAIL_SUBJECT_ADMIN'] = 'The subject of the message for the administrator';
$MESS['KIT_EASYFORM_MAIL_SUBJECT_ADMIN_DEFAULT'] = '# SITE_NAME #: Message from feedback form';
$MESS['KIT_EASYFORM_WRITE_MESS_FILDES_TABLE'] = 'Record fields in the mail template with a table';
$MESS['KIT_EASYFORM_EMAIL_TO'] = 'E-mail to which the message will be sent (by default it is used from module settings)';
$MESS['KIT_EASYFORM_BCC'] = 'Bcc';
$MESS['KIT_EASYFORM_EVEN_BCC'] = '# BCC #';
$MESS['KIT_EASYFORM_RU_NAME'] = 'Sending a message via the KIT super-form';
$MESS['KIT_EASYFORM_RU_DESCRIPTION'] = '=== Service Macros ===
# AUTHOR_NAME # - Author of the message
# SUBJECT # - Subject of the letter
# FORM_NAME # - Form name
# FORM_FIELDS # - The contents of all fields in tabular or line form (depending on the settings of the form component)
# EMAIL_FROM # - Email of the sender of the message (E-mail by default, or value of the form field "E-mail", depending on the settings)
# EMAIL_TO # - Email of the message recipient (it is set in the settings of the comonent)
# EMAIL_BCC # - Email a hidden copy (it is set in the settings of the comonent)

=== The default form field macros ===
# TITLE # - Your Name
# WORK_POSITION # - Position
# WORK_COMPANY # - Company
# EMAIL # - E-mail
# PHONE # - Mobile phone
# ADDRESS # - Address
# SERVICES # - Service
# MESSAGE # - Message

=== Any form fields ===
The value of the character code of any field, for example:
# EMAIL #

=== System macros ===
';
$MESS['KIT_EASYFORM_SUBJECT'] = '# SUBJECT #';
$MESS['KIT_EASYFORM_MESSAGE'] = 'Information message of the site # SITE_NAME # <br>
------------------------------------------ <br>
The <br>
You have been sent a message using form # FORM_NAME # <br>
The <br>
Message text: <br>
# FORM_FIELDS # <br>
The <br>
The message is generated automatically.
';
// IBLOCK
$MESS['KIT_EASYFORM_GROUP_WRITE_IB'] = 'Record results in the information block';
$MESS['KIT_EASYFORM_USE_IBLOCK_WRITE'] = 'Write results to IS';
$MESS['KIT_EASYFORM_IBLOCK_PROP_ADD_NAME'] = 'Create a new IB';
$MESS["KIT_EASYFORM_IBLOCK_DESC_LIST_TYPE"] = "Information block type (only used for verification)";
$MESS["KIT_EASYFORM_IBLOCK_DESC_LIST_ID"] = "Information block code for storing the result";
$MESS['KIT_EASYFORM_ACTIVE_ELEMENT'] = "Deactivate an element when adding?";
$MESS['KIT_EASYFORM_CATEGORY_IBLOCK_FIELD'] = "Property of the information block to which data will be written";
$MESS['KIT_EASYFORM_IBLOCK_FIELD_NO_WRITE'] = "Do not write";
$MESS['KIT_EASYFORM_IBLOCK_FIELD_NAME'] = "Name";
$MESS['KIT_EASYFORM_IBLOCK_FIELD_DETAIL_TEXT'] = "Detailed Description";
$MESS['KIT_EASYFORM_IBLOCK_FIELD_PREVIEW_TEXT'] = "Description for announcement";
$MESS['KIT_EASYFORM_IBLOCK_FIELD_FORM'] = "Create automatically";
$MESS['KIT_EASYFORM_IBLOCK_LANG_RU_NAME'] = "Form Results";
$MESS['KIT_EASYFORM_IBLOCK_LANG_EN_NAME'] = "Form result";
$MESS['KIT_EASYFORM_IBLOCK_PROP_RU_NAME'] = "Create a new IB?";

// CAPTCHA
$MESS['KIT_EASYFORM_CAPTCHA'] = 'Captcha';
$MESS['KIT_EASYFORM_USE_CAPTCHA'] = 'Use captcha reCAPTCHA';
$MESS['KIT_EASYFORM_USE_CAPTCHA_TIP'] = 'Smart CAPTCHA by Google';
$MESS['KIT_EASYFORM_CAPTCHA_BUTTON_NAME'] = 'Customize captcha';
$MESS['KIT_EASYFORM_CAPTCHA_KEY'] = 'ReCAPTCHA key';
$MESS['KIT_EASYFORM_CAPTCHA_KEY_TIP'] = 'You can get the key at https://www.google.com/recaptcha/admin';
$MESS['KIT_EASYFORM_CAPTCHA_SECRET_KEY'] = 'ReCAPTCHA secret key';
$MESS['KIT_EASYFORM_CAPTCHA_SECRET_KEY_TIP'] = 'You can get the private key at https://www.google.com/recaptcha/admin';
$MESS['KIT_EASYFORM_FIELD_CAPTCHA_TITLE'] = 'Title';

// SUBMIT WARNING
$MESS['KIT_EASYFORM_GROUP_PERSONAL_DATA'] = 'Processing of personal data';
$MESS['KIT_EASYFORM_USE_MODULE_VARNING'] = 'Use message from module settings';
$MESS['KIT_EASYFORM_FORM_SUBMIT_VARNING'] = 'The message displayed before the button';
$MESS['KIT_EASYFORM_FORM_SUBMIT_VARNING_TIP'] = "You can use the template #BUTTON# instead of the button name";
$MESS['KIT_EASYFORM_FORM_SUBMIT_VARNING_DEFAULT'] = 'By clicking on the "#BUTTON#" button, you consent to the processing of <a target="_blank" href="#"> personal data </a>';

//GROUP_JS_VALIDATE_SETTINGS
$MESS['KIT_EASYFORM_GROUPS_JS_VALIDATE_SETTINGS'] = "JS Bootstrap Validators";
$MESS['KIT_EASYFORM_USE_FORMVALIDATION_JS'] = 'Scan fields via JS Bootstrap Validators';
$MESS['KIT_EASYFORM_HIDE_FORMVALIDATION_TEXT'] = 'Hide error messages';
$MESS['KIT_EASYFORM_INCLUDE_FORMVALIDATION_LIBS'] = 'Include JS Bootstrap Validators';


// GROUP_JS_VALIDATE_SETTINGS
$MESS['KIT_EASYFORM_GROUPS_JS_LIB_SETTINGS'] = "JS plug-ins";
$MESS['KIT_EASYFORM_INCLUDE_JQUERY'] = 'Connect jQuery-1.12.4';
$MESS['KIT_EASYFORM_USE_BOOTSRAP_CSS'] = 'Connect Standard Bootstrap Styles 3';
$MESS['KIT_EASYFORM_USE_BOOTSRAP_JS'] = 'Connect standard JS Bootstrap 3';
$MESS['KIT_EASYFORM_USE_DROPZONE_JS'] = 'Connect boot loader DragnDrop';
$MESS['KIT_EASYFORM_USE_BOOTSRAP_JS_TIP'] = 'Required for the modal window';
$MESS['KIT_EASYFORM_USE_INPUTMASK_JS'] = 'Connect JS Inputmask';
$MESS['KIT_EASYFORM_USE_INPUTMASK'] = 'Enable mask';

// GROUP FIELDS
$MESS['KIT_EASYFORM_GROUP_FIELD_TITLE'] = '- field settings';
$MESS['KIT_EASYFORM_GROUP_FIELD_NAME'] = 'Name';
$MESS['KIT_EASYFORM_TYPE_FIELD'] = 'Field Type';
$MESS['KIT_EASYFORM_TYPE_FIELD_ACCEPT'] = '(Consent)';
$MESS['KIT_EASYFORM_GROUP_FIELD_REQ'] = 'Additional validation rules';
$MESS['KIT_EASYFORM_GROUP_FIELD_VALUE'] = 'Value';
$MESS['KIT_EASYFORM_GROUP_FIELD_VALUE_EMAIL'] = 'The value of linked email';
$MESS['KIT_EASYFORM_GROUP_FIELD_VALUE_EMAIL_VAL_1'] = 'sale@site.ru';
$MESS['KIT_EASYFORM_GROUP_FIELD_VALUE_EMAIL_VAL_2'] = 'partners@site.ru';
$MESS['KIT_EASYFORM_GROUP_FIELD_SELECT_ADD'] = 'Additional value (entered manually)';
$MESS['KIT_EASYFORM_GROUP_FIELD_SELECT_ADD_DEF'] = 'Other (write your own)';
$MESS['KIT_EASYFORM_GROUP_FIELD_FILE_EXTENSION'] = 'Valid file extensions (separated by commas)';
$MESS['KIT_EASYFORM_GROUP_FIELD_FILE_MAX_SIZE'] = 'Maximum file size (in Kb)';
$MESS['KIT_EASYFORM_GROUP_FIELD_INPUTMASK_TEMP'] = 'Mask template';
$MESS['KIT_EASYFORM_GROUP_FIELD_VIEW'] = 'Horizontal display of values';

// VALIDATION_MESSAGES
$MESS['KIT_EASYFORM_FIELD_VALIDATION_MESSAGE'] = 'Text on error';
$MESS['KIT_EASYFORM_FIELD_VALIDATION_ADDITIONALLY_MESSAGE'] = 'Additional validation parameters';
$MESS['KIT_EASYFORM_FIELD_VALIDATION_MESSAGE_DEFAULT'] = 'Required field';
$MESS['KIT_EASYFORM_FIELD_VALIDATION_MESSAGE_EMAIL_DEFAULT'] = 'E-mail entered incorrectly';
?>
