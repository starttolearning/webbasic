<?php

// 1. Close file first. Can't delete open files
// 2. Must have write permission on the folder cntaining the file

// Delete file(carefully) with: 
unlink("filetext.txt");
