# Project: 26_digital_test
# Author: Ryan Bloor

A simple website that does the following: 

1. fetches a problem from http://tech-test.twentysixstaging.com/ using a CURL GET request

2. parses the result based on its content type, e.g. xml, json or text

3. solves the problem by identifying what type it is from the parsed object

4. sends a CURL GET request to a URL consisting of the endpoint from the parsed object and the answer worked out previously

5. parses the result based on its content type, e.g. xml, json or text

6. Outputs details of the problem and solution to the page with a link to fetch a new problem

NOTE: 

There are numerous database errors (on the staging site) when submitting a solution to the server, which means that step 5 cannot not parse the request properly. As a workaround, I've done a naive preg_match for the string "Correct!" in the data response.

Once the database errors are fixed, line 55 of index.php should be replaced with the following to properly determine if the answer to the problem was correct. 

<td>echo $response_parser->parsed_data->message;</td>

DESIGN CHOICES:

With the website being a single page I opted against using a framework such as Laravel and a package manager such as composer.