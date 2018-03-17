<?php

    //TODO: SAVE THIS IN REDIS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    $content = file_get_contents('./mining.md');
    echo $content === false
        ? 'Could not read mining contents.'
        : $content;