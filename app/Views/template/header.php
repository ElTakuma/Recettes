<html>
<head>
    <title>
        <?= esc($head_title) ?> - Recette
    </title>
    <style>
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 22px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .button:active{
            padding: 8px 20px;
        }
        .button-blue {
            background-color: white;
            color: dodgerblue;
            border: 1px solid dodgerblue;
        }
        .button-blue:hover {
            background-color: dodgerblue;
            color: white;
        }
        .button-red {
            background-color: white;
            color: red;
            border: 1px solid red;
        }
        .button-red:hover {
            background-color: red;
            color: white;
        }
        .button-black {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        .button-black:hover {
            background-color: black;
            color: white;
        }
        .button-green {
            background-color: white;
            color: green;
            border: 1px solid green;
        }
        .button-green:hover {
            background-color: green;
            color: white;
        }
        .text-form{
            width: 100%;
            height: 35px;
            font-size: 16px;
            /*border: 1px #dddddd inset;*/
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding-left: 10px;
        }
        .label {
            font-weight: bolder;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div style="padding: 30px; margin-left: 50px; height: 25px">
    <span style="font-size: 40px; font-weight: bolder"><?= esc($body_title) ?> </span>
    <span style="font-size: 40px;">&nbsp; <?= esc($body_title_mention) ?> </span>
</div>
<hr>

