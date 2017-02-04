<?php

include 'vendor/autoload.php';

use wappr\SrcSet;

echo SrcSet::img('https://cdn.levi.lol/assets/images/1701/dir/corn.png', 760, 'hello',
    [320, 768, 1224, 1824]
);
