<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Company extends Controller
{
  public function index()
  {
    $employees = [
        [
            'image' => '9.png',
            'name' => 'John Doe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Ultrices eros in cursus turpis massa tincidunt.',
            'phone' => '(123) 456-7890',
            'email' => 'john.doe@example.com',
            'linkedin' => 'https://www.linkedin.com/in/johndoe',
            'twitter' => 'https://twitter.com/johndoe',
            'facebook' => 'https://www.facebook.com/johndoe',
            'instagram' => 'https://www.instagram.com/johndoe',
        ],
        [
            'image' => '2.png',
            'name' => 'John Doe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Ultrices eros in cursus turpis massa tincidunt.',
            'phone' => '(123) 456-7890',
            'email' => 'john.doe@example.com',
            'linkedin' => 'https://www.linkedin.com/in/johndoe',
            'twitter' => 'https://twitter.com/johndoe',
            'facebook' => 'https://www.facebook.com/johndoe',
            'instagram' => 'https://www.instagram.com/johndoe',
        ],
        [
            'image' => '3.png',
            'name' => 'John Doe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Ultrices eros in cursus turpis massa tincidunt.',
            'phone' => '(123) 456-7890',
            'email' => 'john.doe@example.com',
            'linkedin' => 'https://www.linkedin.com/in/johndoe',
            'twitter' => 'https://twitter.com/johndoe',
            'facebook' => 'https://www.facebook.com/johndoe',
            'instagram' => 'https://www.instagram.com/johndoe',
        ],
        [
            'image' => '4.png',
            'name' => 'John Doe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Ultrices eros in cursus turpis massa tincidunt.',
            'phone' => '(123) 456-7890',
            'email' => 'john.doe@example.com',
            'linkedin' => 'https://www.linkedin.com/in/johndoe',
            'twitter' => 'https://twitter.com/johndoe',
            'facebook' => 'https://www.facebook.com/johndoe',
            'instagram' => 'https://www.instagram.com/johndoe',
        ],
        [
            'image' => '5.png',
            'name' => 'John Doe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Ultrices eros in cursus turpis massa tincidunt.',
            'phone' => '(123) 456-7890',
            'email' => 'john.doe@example.com',
            'linkedin' => 'https://www.linkedin.com/in/johndoe',
            'twitter' => 'https://twitter.com/johndoe',
            'facebook' => 'https://www.facebook.com/johndoe',
            'instagram' => 'https://www.instagram.com/johndoe',
        ],
        [
            'image' => '6.png',
            'name' => 'John Doe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Ultrices eros in cursus turpis massa tincidunt.',
            'phone' => '(123) 456-7890',
            'email' => 'john.doe@example.com',
            'linkedin' => 'https://www.linkedin.com/in/johndoe',
            'twitter' => 'https://twitter.com/johndoe',
            'facebook' => 'https://www.facebook.com/johndoe',
            'instagram' => 'https://www.instagram.com/johndoe',
        ],
        // Add more employee records as needed
    ];

    return view('content.company.company-details', compact('employees'));
  }

  public function directory()
  {
    return view('content.company.company-directory');
  }
}
