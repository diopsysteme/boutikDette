<?php

namespace Model;

use Core\MysqlDatabase;
use Entity\ClientEntity;
use Core\Model;

class ArticleModel extends Model
{
    public function __construct(MysqlDatabase $database) {
        parent::__construct($database);
    }
}
