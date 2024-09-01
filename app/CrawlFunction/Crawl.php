<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 12/18/2018
 * Time: 2:25 PM
 */

namespace App\CrawlFunction;


use App\ThirdParty;
use Illuminate\Support\Facades\Mail;

class Crawl
{
    public function stringifyPage($url)
    {
        $content = file_get_contents($url);
        return $content;
    }

    public function match($content, $pattern)
    {
        $match = preg_match_all($pattern, $content, $estimates);
        return $estimates;
    }

    public static function crawl()
    {
        $newDataAdded = 0;
        $newDataUpdated = 0;
        $url = 'http://www.rentalnepal.com/property-type/house/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);
        $classname = "property-list-content";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = $img;
            }

            $x = $node->getElementsByTagName("span")[0];
            $y = $x->childNodes[0];
            $status = $y->nodeValue;

            $x = $node->getElementsByTagName("h5")[0];
            $y = $x->childNodes[0];
            $price = $y->nodeValue;


            $x = $node->getElementsByTagName("strong")[0];
            $y = $x->childNodes[0];
            $title = $y->nodeValue;

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $location = $y->nodeValue;

            $category = 'house';

            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'rentalnepal';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAdded += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdated += 1;
            }

        }


        $url = 'http://www.rentalnepal.com/property-type/flat-and-apartment/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultFlat = [];

        $finder = new \DOMXPath($doc);
        $classname = "property-list-content";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = $img;
            }

            $x = $node->getElementsByTagName("span")[0];
            $y = $x->childNodes[0];
            $status = $y->nodeValue;

            $x = $node->getElementsByTagName("h5")[0];
            $y = $x->childNodes[0];
            $price = $y->nodeValue;


            $x = $node->getElementsByTagName("strong")[0];
            $y = $x->childNodes[0];
            $title = $y->nodeValue;

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $location = $y->nodeValue;

            $category = 'flat';

            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'rentalnepal';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAdded += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdated += 1;
            }
        }


        $url = 'http://www.rentalnepal.com/property-type/office/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultOffice = [];

        $finder = new \DOMXPath($doc);
        $classname = "property-list-content";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = $img;
            }

            $x = $node->getElementsByTagName("span")[0];
            $y = $x->childNodes[0];
            $status = $y->nodeValue;

            $x = $node->getElementsByTagName("h5")[0];
            $y = $x->childNodes[0];
            $price = $y->nodeValue;


            $x = $node->getElementsByTagName("strong")[0];
            $y = $x->childNodes[0];
            $title = $y->nodeValue;

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $location = $y->nodeValue;

            $category = 'office';

            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'rentalnepal';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAdded += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdated += 1;
            }


        }

        $url = 'http://www.rentalnepal.com/property-type/shutters-and-shop-space/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultshop = [];

        $finder = new \DOMXPath($doc);
        $classname = "property-list-content";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = $img;
            }

            $x = $node->getElementsByTagName("span")[0];
            $y = $x->childNodes[0];
            $status = $y->nodeValue;

            $x = $node->getElementsByTagName("h5")[0];
            $y = $x->childNodes[0];
            $price = $y->nodeValue;


            $x = $node->getElementsByTagName("strong")[0];
            $y = $x->childNodes[0];
            $title = $y->nodeValue;

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $location = $y->nodeValue;

            $category = 'shop';

            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'rentalnepal';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAdded += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdated += 1;
            }

        }


        $url = 'http://www.rentalnepal.com/property-type/rooms/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultRoom = [];

        $finder = new \DOMXPath($doc);
        $classname = "property-list-content";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = $img;
            }

            $x = $node->getElementsByTagName("span")[0];
            $y = $x->childNodes[0];
            $status = $y->nodeValue;

            $x = $node->getElementsByTagName("h5")[0];
            $y = $x->childNodes[0];
            $price = $y->nodeValue;


            $x = $node->getElementsByTagName("strong")[0];
            $y = $x->childNodes[0];
            $title = $y->nodeValue;

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $location = $y->nodeValue;

            $category = 'room';

            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'rentalnepal';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAdded += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdated += 1;
            }
        }


//        this portuin is for gharbeti
        $newDataAddedGb = 0;
        $newDataUpdatedGb = 0;
        $url = 'https://www.gharbheti.com/premium-properties/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Feature_building";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

//                   echo '<pre>';
//                   print_r($ps);
                    $count++;
                }
            }


            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;

            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];


            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }


        $url = 'https://www.gharbheti.com/featured-properties/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Feature_building";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }

        $url = 'https://www.gharbheti.com/general-properties/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Search_building";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }


        $url = 'https://www.gharbheti.com/general-properties/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);
        $classname = "Search_flat";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }

        $url = 'https://www.gharbheti.com/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Premium_flat";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }


        $url = 'https://www.gharbheti.com/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Premium_building";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }

        $url = 'https://www.gharbheti.com/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Feature_building";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }

        $url = 'https://www.gharbheti.com/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Feature_flat";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }

        $url = 'https://www.gharbheti.com/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Search_flat";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }

        $url = 'https://www.gharbheti.com/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);

        $classname = "Search_building";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }

        }

        $url = 'https://www.gharbheti.com/popular-location-for-rent/';
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        libxml_use_internal_errors(false);
        $resultHouse = [];

        $finder = new \DOMXPath($doc);
        $classname = "Search_room";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        foreach ($nodes as $node) {
            foreach ($node->getElementsByTagName("a") as $anchor) {
                $href = $anchor->getAttribute("href");
                $link = 'https://www.gharbheti.com' . $href;
            }

            foreach ($node->getElementsByTagName("img") as $image) {
                $img = $image->getAttribute("src");
                $image = 'https://www.gharbheti.com' . $img;
            }


            $status = 'Available';

            $count = 0;
            foreach ($node->getElementsByTagName("span") as $priceSpan) {
                foreach ($priceSpan->getElementsByTagName("span") as $ps) {
                    if ($count == 0)
                        $priceElemtn = $ps;

                    if ($count == 1)
                        $categoryElemtn = $ps;

                    $count++;
                }
            }

            $price = $priceElemtn->childNodes[0];
            $price = $price->nodeValue;


            $category = $categoryElemtn->childNodes[0];
            $category = $category->nodeValue;
            $category = array_map('trim', explode('-', $category));
            $category = $category[0];

            $x = $node->getElementsByTagName("p")[0];
            $y = $x->childNodes[0];
            $title = $y->data;
            $title = str_replace(array("\n", "\r"), '', $title);


            $x = $node->getElementsByTagName("small")[1];
            $y = $x->childNodes[1];
            $location = str_replace(' ', '', $y->nodeValue);


            $dataToStore['title'] = $title;
            $dataToStore['location'] = $location;
            $dataToStore['category'] = $category;
            $dataToStore['price'] = $price;
            $dataToStore['status'] = $status;
            $dataToStore['image'] = $image;
            $dataToStore['link'] = $link;
            $dataToStore['source'] = 'gharbheti';

            if (ThirdParty::where('link', $link)->count() == 0) {
                ThirdParty::create($dataToStore);
                $newDataAddedGb += 1;
            } else {
                ThirdParty::where('link', $link)->update($dataToStore);
                $newDataUpdatedGb += 1;
            }
        }

        $mailBody = 'This email is intended to notify Rentonnepal admins about the datas crawling from third party !';
        $mailData['body'] = $mailBody;
        $mailData['subject'] = 'Data successfully crawled from third party source !';
        $mailData['data_added_from_rentalnepal'] = $newDataAdded;
        $mailData['data_updated_from_rentalnepal'] = $newDataUpdated;
        $mailData['data_added_from_gb'] = $newDataAddedGb;
        $mailData['data_updated_from_gb'] = $newDataUpdatedGb;
        Mail::to(['nepalrenton@gmail.com'])
            ->send(new \App\Mail\Crawl($mailData));
    }
}
