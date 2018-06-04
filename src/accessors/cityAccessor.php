<?php
    require_once( "../db/dbConstants.php" );

    use Aws\DynamoDb\Exception\DynamoDbException;
    use Aws\DynamoDb\Marshaler;

    class CityAccessor {
        private $dynamodb;
        private $marshaler;

        function __construct() {
            global $awsSDK;
            $this->dynamodb = $awsSDK->createDynamoDb();
            $this->marshaler = new Marshaler();
        }

        function getCity($cityName) {
            $key = $this->marshaler->marshalJson('{"name": "' . $cityName . '"}');
            $params = [
                'TableName' => CITY_TABLE,
                'Key' => $key
            ];
            try {
                $result = $this->dynamodb->getItem($params);
                if($result["Item"] != NULL) {
                    return $this->getCityObject($result["Item"]);
                }
            } catch (DynamoDbException $e) {
                echo "Unable to get item:\n";
                echo $e->getMessage() . "\n";
            }
            return NULL;
        }

        function getAllCities() {
            $params = [
                'TableName' => CITY_TABLE
            ];
            $cities = array();
            try {
                while (true) {
                    $result = $this->dynamodb->scan($params);
                    foreach ($result['Items'] as $i) {
                        $city = $this->getCityObject($i);
                        array_push($cities, $city);
                    }
                    if (isset($result['LastEvaluatedKey'])) {
                        $params['ExclusiveStartKey'] = $result['LastEvaluatedKey'];
                    } else {
                        break;
                    }
                }
            } catch (DynamoDbException $e) {
                echo "Unable to scan the table : " . $params['TableName'] . " \n";
                echo $e->getMessage() . "\n";
            }
            return $cities;
        }

        function insertCity(City $city) {
            $cityJson = json_encode([
                'name' => $city->name,
                'id' => $city->id,
                'country' => $city->country,
                'state' => $city->state
            ]);

            $params = [
                'TableName' => CITY_TABLE,
                'Item' => $this->marshaler->marshalJson($cityJson)
            ];

            try {
                $this->dynamodb->putItem($params);
                return true;
            } catch (DynamoDbException $e) {
                echo "Unable to add movie:\n";
                echo $e->getMessage() . "\n";
                return false;
            }
        }

        private function getCityObject($result) {
            $city = new City();
            $city->name = $this->marshaler->unmarshalValue($result["name"]);
            $city->id = $this->marshaler->unmarshalValue($result["id"]);
            $city->state = $this->marshaler->unmarshalValue($result["state"]);
            $city->country = $this->marshaler->unmarshalValue($result["country"]);
            return $city;
        }
    }

    $cityAccessor = new CityAccessor();
?>