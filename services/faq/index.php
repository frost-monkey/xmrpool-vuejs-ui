<?php

    //TODO: SAVE THIS IN REDIS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    $content = file_get_contents('./faq.md');
    echo $content === false
        ? 'Could not read FAQ contents.'
        : $content;