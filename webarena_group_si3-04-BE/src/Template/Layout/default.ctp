<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'SolidLight';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('https://fonts.googleapis.com/css?family=Orbitron:700') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <style>
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            font-family: 'Orbitron', sans-serif;
            color: #18FFFF;
            background-color: #333;
            height: auto;
            font-size: 12px;
            padding: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer .float-right {
            /*float: right;*/
        }

        footer .float-left {
            text-shadow: 0 0 10px #18FFFF;
        }
    </style>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <span>Solid Light</span>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li> <?php echo $this->Html->link("Home", ["controller"=>"Arenas", "action"=>"index"]); ?> </li>
                <li> <?php echo $this->Html->link("Login", ["controller"=>"Arenas", "action"=>"login"]); ?> </li>
                <li> <?php echo $this->Html->link("Hall Of Fame", ["controller"=>"Arenas", "action"=>"halloffame"]); ?> </li>
                <li> <?php echo $this->Html->link("Fighter", ["controller"=>"Arenas", "action"=>"fighter"]); ?> </li>
                <li> <?php echo $this->Html->link("Arena", ["controller"=>"Arenas", "action"=>"sight"]); ?> </li>
                <li> <?php echo $this->Html->link("Fight Diary", ["controller"=>"Arenas", "action"=>"diary"]); ?> </li>
                <li> <?php echo $this->Html->link("Guilds", ["controller"=>"Arenas", "action"=>"guild"]); ?> </li>
                <li> <?php echo $this->Html->link("Inbox", ["controller"=>"Arenas", "action"=>"inbox"]); ?> </li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        <div class="float-left">Cante / Duplan / Elkhiati / Segard</div>
        <div class="float-center">Git Log as Word document inside project</div>
        <div class="float-right">Options B - E</div>
    </footer>
</body>
</html>
