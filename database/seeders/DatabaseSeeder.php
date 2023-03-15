<?php

namespace Database\Seeders;

use App\Models\orcid;
use App\Models\keyword;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $urls = [
        'https://pub.orcid.org/v3.0/0000-0003-3580-8766',
        'https://pub.orcid.org/v3.0/0000-0002-5425-8950',
        'https://pub.orcid.org/v3.0/0000-0002-5337-4722',
        'https://pub.orcid.org/v3.0/0000-0002-5374-9993',

    ];

    public function run()
    {
        foreach($this->urls as $url){
            $this->create_orcid($url);
        }
    }

    public function create_orcid($url)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get($url);
        $orcid_identifier = $response['orcid-identifier']['path'];
        $given_names = $response['person']['name']['given-names']['value'];
        $family_name = $response['person']['name']['family-name']['value'];
        $keyword_content = $response['person']['keywords']['keyword'];
        $emails = $response['person']['emails']['email'];
        $orcid = orcid::create([
            'orcid_identifier_path' =>  $orcid_identifier,
            'given_names' =>  $given_names,
            'family_name' => $family_name,
            'email_primary' => $this->getEmailPrimary($emails),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $this->create_keywords($orcid->id, $keyword_content);
    }
    public function getEmailPrimary($data)
    {
        foreach ($data as $email) {
            if ($email['primary']) {
                $email_primary = $email['email'];
                return $email_primary;
            }
        }
    }
    public function create_keywords($id, $data)
    {
        foreach ($data as $keyword_content) {
            keyword::create([
                'content' => $keyword_content['content'],
                'orcid_id' => $id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
