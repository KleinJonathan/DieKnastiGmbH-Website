<!-- Header zum einfügen in jede Datei mit Titel, Tabtitle -->
<html lang="de" id="top">

<head>
    <title><?php echo $title; ?></title>
    <meta content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href=<?php echo root_url("./styles/main.css") ?>>
    <link rel="icon" href=<?php echo root_url("./favicon.ico") ?>>
</head>

<body>
    <header>
        <h1><?php echo $headerTitle ?></h1>
        <h2><?php echo $headerSubTitle ?></h2>
    </header>