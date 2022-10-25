<?php

namespace GraphQL;

require_once '../vendor/autoload.php';


use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;


class Database
{
    private static $sql_connection;

    public static function init($config)
    {
        self::$sql_connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
    }

    public static function select_one($query)
    {
        $records = self::select($query)->fetch_all(MYSQLI_ASSOC);
        return $records[0];
    }

    public static function select($query)
    {
        return self::$sql_connection->query($query);
    }

    public static function insert($query) 
    {
        self::$sql_connection->query($query);
    }

    public static function update($query) 
    {
        return self::$sql_connection->query($query);
    }

    public static function delete($query) 
    {
        return self::$sql_connection->query($query);
    }
}


class DessertType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'ID' => [
                        'type' => Types::int(),
                        'description' => 'Dessert ID'
                    ],
                    'title' => [
                        'type' => Types::string(),
                        'description' => 'Dessert title'
                    ],
                    'price' => [
                        'type' => Types::int(),
                        'description' => 'Dessert price'
                    ],
                    'calories' => [
                        'type' => Types::int(),
                        'description' => 'Dessert calories'
                    ]
                ];
            }
        ];
        parent::__construct($config);
    }
}


class InputDessertType extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'title' => [
                        'type' => Types::nonNull(Types::string()),
                        'description' => 'Dessert title'
                    ],
                    'price' => [
                        'type' => Types::nonNull(Types::int()),
                        'description' => 'Dessert price'
                    ],
                    'calories' => [
                        'type' => Types::nonNull(Types::int()),
                        'description' => 'Dessert calories'
                    ]
                ];
            }
        ];
        parent::__construct($config);
    }
}


class DrinkType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'ID' => [
                        'type' => Types::int(),
                        'description' => 'Drink ID'
                    ],
                    'title' => [
                        'type' => Types::string(),
                        'description' => 'Drink title'
                    ],
                    'price' => [
                        'type' => Types::int(),
                        'description' => 'Drink price'
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}


class InputDrinkType extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'title' => [
                        'type' => Types::nonNull(Types::string()),
                        'description' => 'Drink title'
                    ],
                    'price' => [
                        'type' => Types::nonNull(Types::int()),
                        'description' => 'Drink price'
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}


class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'dessert' => [
                        'type' => Types::dessert(),
                        'args' => [
                            'ID' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            return Database::select_one("SELECT * FROM desserts where id = {$args['ID']}");
                        }
                    ],
                    'drink' => [
                        'type' => Types::drink(),
                        'args' => [
                            'ID' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            return Database::select_one("SELECT * FROM drinks where id = {$args['ID']}");
                        }
                    ],
                    'allDesserts' => [
                        'type' => Types::listOf(Types::dessert()),
                        'resolve' => function () {
                            return Database::select('SELECT * FROM desserts');
                        }
                    ],
                    'allDrinks' => [
                        'type' => Types::listOf(Types::drink()),
                        'resolve' => function () {
                            return Database::select('SELECT * FROM drinks');
                        }
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}


class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'createDessert' => [
                        'type' => Types::dessert(),
                        'args' => [
                            'dessert' => Types::inputDessert()
                        ],
                        'resolve' => function ($root, $args) {
                            Database::insert("INSERT INTO desserts (title, price, calories) VALUES ('{$args['dessert']['title']}', {$args['dessert']['price']}, {$args['dessert']['calories']})");
                            return Database::select_one('SELECT * FROM desserts ORDER BY ID DESC LIMIT 1');
                        },
                    ],
                    'createDrink' => [
                        'type' => Types::drink(),
                        'args' => [
                            'drink' => Types::inputDrink()
                        ],
                        'resolve' => function ($root, $args) {
                            Database::insert("INSERT INTO drinks (title, price) VALUES ('{$args['drink']['title']}', {$args['drink']['price']})");
                            return Database::select_one('SELECT * FROM drinks ORDER BY ID DESC LIMIT 1');
                        },
                    ],
                    'updateDessertPrice' => [
                        'type' => Types::dessert(),
                        'args' => [
                            'ID' => Types::int(),
                            'price' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            Database::update("UPDATE desserts set price = {$args['price']} where id = {$args['ID']}");
                            return Database::select_one("SELECT * FROM desserts where id = {$args['ID']}");
                        }
                    ],
                    'updateDrinkPrice' => [
                        'type' => Types::drink(),
                        'args' => [
                            'ID' => Types::int(),
                            'price' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            Database::update("UPDATE drinks set price = {$args['price']} where id = {$args['ID']}");
                            return Database::select_one("SELECT * FROM drinks where id = {$args['ID']}");
                        }
                    ],
                    'deleteDrink' => [
                        'type' => Types::string(),
                        'args' => [
                            'ID' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            $result = Database::delete("DELETE FROM drinks WHERE ID = {$args['ID']}");
                            return 'Successfully deleted!';
                        },
                    ],
                    'deleteDessert' => [
                        'type' => Types::string(),
                        'args' => [
                            'ID' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            $result = Database::delete("DELETE FROM desserts WHERE ID = {$args['ID']}");
                            return 'Successfully deleted!';
                        },
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}


class Types
{
    private static $query;
    private static $mutation;

    private static $drink;
    private static $dessert;

    private static $inputDrink;
    private static $inputDessert;

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new MutationType());
    }

    public static function dessert() {
        return self::$dessert ?: (self::$dessert = new DessertType());
    }

    public static function inputDessert() {
        return self::$inputDessert ?: (self::$inputDessert = new InputDessertType());
    }

    public static function drink() {
        return self::$drink ?: (self::$drink = new DrinkType());
    }

    public static function inputDrink() {
        return self::$inputDrink ?: (self::$inputDrink = new InputDrinkType());
    }

    public static function string()
    {
        return Type::string();
    }

    public static function int()
    {
        return Type::int();
    }

    public static function listOf($type)
    {
        return Type::listOf($type);
    }
    
    public static function nonNull($type)
    {
        return Type::nonNull($type);
    }
}


$DB_CONFIG = [
    'host' => "db",
    'username' => "root",
    'password' => "12345678", 
    'dbname' => "appDB"
];

$schema = new Schema([
    'query' => Types::query(),
    'mutation' => Types::mutation()
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        Database::init($DB_CONFIG);
        
        $rawInput = file_get_contents('php://input');
        if ($rawInput === false) {
            throw new RuntimeException('Failed to get php://input');
        }

        $input = json_decode($rawInput, true);
        $query = $input['query'];


        $result = GraphQL::executeQuery($schema, $query, null, null, null);
        $output = $result->toArray();

    } catch (Throwable $e) {
        $output = [
            'error' => [
                'message' => $e->getMessage(),
            ],
        ];
    }

    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($output);
}