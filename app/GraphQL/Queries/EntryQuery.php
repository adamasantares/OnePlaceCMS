<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Entry;
use function Safe\swoole_async_write;

class EntryQuery
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function formatFields($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $result = [];
        $modelFields = $rootValue->model->fields;

        foreach ($modelFields as $field) {
            $key = $field['api_id'];

            switch ($field['type']) {
                case "media":
                    $medias = $rootValue->getMedia($key);

                    foreach ($medias as $media) {
                        $result[$key][] = $media->getFullUrl();
                    }

                    break;

                case "relation":
                    if($field['validations']['relation_type'] === 'one_to_many') {
                        if(isset($rootValue->fields[$key])) {
                            $result[$key] = Entry::whereIn('_id', $rootValue->fields[$key])->where('published', true)->get();
                        } else {
                            $result[$key] = null;
                        }
                    }

                    break;

                default:
                    $result[$key] = $rootValue->fields[$key];

                    break;
            }

        }

        return $result;
    }
}
