<?php

// Define the URL of the website to crawl
$url = 'https://sapiencoder.com';

// Define an array to keep track of visited URLs
$visited_urls = [];

// Define a recursive function to crawl the website
function crawl($url, &$visited_urls) {
    try {
        // Use file_get_contents() to retrieve the HTML of the page
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
            ],
        ]);
        $html = file_get_contents($url, false, $context);

        if(!$html) {
            return;
        }

        // Use DOMDocument to get all the links on the page
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $links = $dom->getElementsByTagName('a');

        // Loop through each link and crawl its URL if it hasn't been visited already
        foreach ($links as $link) {
            $linked_url = $link->getAttribute('href');
            if (strpos($linked_url, 'http') !== false && !in_array($linked_url, $visited_urls)) {
                $visited_urls[] = $linked_url;
                echo $linked_url . "\n";
                if($linked_url){
                    crawl($linked_url, $visited_urls);
                }
            }
        }
    } catch (ErrorException $e) {
        // Handle the "403 Forbidden" exception
       // echo 'Error crawling URL: ' . $url . ' - ' . $e->getMessage() . "\n";
    } catch (Exception $e) {
        // Handle other exceptions
      //  echo 'Error crawling URL: ' . $url . ' - ' . $e->getMessage() . "\n";
    }
}

// Call the crawl() function to start crawling the website
crawl($url, $visited_urls);