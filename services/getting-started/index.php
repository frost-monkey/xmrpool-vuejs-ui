<?php

    //TODO: SAVE THIS IN REDIS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    $content = file_get_contents('./getting-started.md');
    echo $content === false
        ? 'Could not read Getting Started contents.'
        : $content;