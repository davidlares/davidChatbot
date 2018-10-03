<?php
function jsonFormat($image){
  $array = ['attachment' =>
          ['type' => 'template',
            'payload' =>
              ['template_type' => 'generic',
                'elements' => [[
                  'title' => 'Is this the right picture?',
                  'subtitle' => 'Tap to answer',
                  'image_url' => $image,
                  'buttons'=> [
                    ['type' => 'postback', 'title' => 'Yes!', 'payload' => 'yes'],
                    ['type' => 'postback', 'title' => 'No!', 'payload' => 'no']
                  ]
                ]]
              ]
            ]
        ];
  return $array;
}
