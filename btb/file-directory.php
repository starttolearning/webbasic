<?php
// we already used
// dirname()
// is_dir()


// getcwd(): current working directory

echo getcwd();


// mkdir() : make a directory

if(mkdir('new', 0777)); // 0777 is the linux default

// you can use umask() to change default permission setting
// default may be 0022

// recursive dir creationg

mkdir('new/test/test2',0777,true);

// changing dirs

chdir('new');
echo getcwd();

chdir('..');

rmdir( 'new',true );