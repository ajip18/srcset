<?php

include 'vendor/autoload.php';

use wappr\SrcSet;

echo SrcSet::img('corn.png', 760, 'hello',
    [320, 768, 1224, 1824]
);
