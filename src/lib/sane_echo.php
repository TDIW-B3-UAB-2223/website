<?php
    function saneEcho(string|null $output) {
        echo htmlspecialchars($output ?? "", ENT_QUOTES, 'UTF-8');
    }