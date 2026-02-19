<?php
// mulai session
session_start();

// hapus session
session_destroy();

header('location:login.php?pesan=logout');
