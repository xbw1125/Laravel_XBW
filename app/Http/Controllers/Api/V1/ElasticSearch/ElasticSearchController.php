<?php

namespace App\Http\Controllers\Api\V1\ElasticSearch;

use App\Http\Controllers\Controller;
use Elasticsearch\ClientBuilder;

class ElasticSearchController extends Controller
{
    protected $client;

    public function __construct()
    {
        $host = [
            '192.168.0.103'
        ];
        $this->client = ClientBuilder::create()->setHosts($host)->build();
    }

    public function createIndex()
    {
        $params = [
            'index' => 'my_index1',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0
                ],
                'mappings' => [
                    'my_type' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'first_name' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ],
                            'age' => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->client->indices()->create($params);
        dd($response);
    }

    public function insertDoc()
    {
        $response = $this->client->index([
            'index' => 'my_index',
            'type' => 'my_type',
            'body' => ['first_name' => '我爱中国共产党1', 'age' => 15]
        ]);
        dd($response);
    }

    public function updateDoc()
    {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'cqIATXoBhNTL5pdZzF21',
            'body' => [
                'doc' => [
                    'age' => 25,
                    'first_name' => '我爱中国共产党2'
                ]
            ]
        ];
        $response = $this->client->update($params);
        dd($response);
    }

    public function getDoc()
    {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'cqIATXoBhNTL5pdZzF21'
        ];
//        $response = $this->client->get($params);
        $response = $this->client->getSource($params);
        dd($response);
    }

    public function searchDoc()
    {
//        $params = [
//            'index' => 'my_index',
//            'type' => 'my_type',
//            'body' => [
//                'query' => [
//                    'match' => [
//                        'first_name' => '中国'
//                    ]
//                ]
//            ]
//        ];
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'body' => [
                'from' => 0, //从第几天开始返回
                'size' => 5, //返回结果数量 limit
                'query' => [
                    'bool' => [
                        'must' => [
                            ['match' => ['first_name' => '中']],
//                            ['match' => ['age' => 15]],
                        ],
                        'filter' => [
                            'bool' => [
                                'should' => [
                                    [
                                        'range' => [
                                            'age' => [
                                                'gte' => 18
                                            ]
                                        ]
                                    ],
                                    [
                                        'term' => [
                                            'age' => 25
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ],
                ]
            ]
        ];
        $response = $this->client->search($params);
        dd($response['hits']['hits'] ?? []);
    }

    public function deleteDoc()
    {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id'
        ];
        $response = $this->client->delete($params);
        dd($response);
    }

    public function deleteIndex()
    {
        $deleteParams = [
            'index' => 'my_index'
        ];
        $response = $this->client->indices()->delete($deleteParams);
        dd($response);
    }
}