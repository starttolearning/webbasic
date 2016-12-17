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
