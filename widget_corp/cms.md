#CMS Content Manage System Creating Guide
 * Public views content(read-only)
 * Admin edit content
   * CRUD: Create, Read, Update, Delete

##How to create a project
 * -Start by creating a project blueprint
 *  -Draw diagrams or type up notes
 *  -Clarifies work ahead
 *  -Confront problems early
 *  -Don't clutter your brain
 *  -Develop section by section
 *
##Building the CMS Database
 * -Modeling
 *  -subjects:id, menu_name, position,visible
 *  -pages:id, subject_id, menu_name, position, visible, content
 *  -admins:id, username, password
 *
##Establish Work Area
File structures
 *  -widget_corp (project name)
 *  --incs
 *  --public
 *  ---images
 *  ---js
 *  ---css
 *  ---index.php
 *  ---admin.php
 *  ---manage-content.php
###Code Refactoring
Revising existing code to changes its structure or appearance without changing its behavior.

* Simplicity
* Clarity
* Maintainability
* Efficiency
* Flexibility
  * Reusability
  * Extensibility

## Session is most used for:
* User authentication
  * $logged_in, $user_id

* Holding data during a redirect
  * $message, $error

* Frequently referred to data
  * $username, $account_type