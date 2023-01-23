<?php
    function saneEcho($output) {
        echo htmlspecialchars($output ?? "", ENT_QUOTES, 'UTF-8');
    }