<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 12/2/2018
 * Time: 12:25 PM
 */?>
<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="../../Scripts/CanvasEditor.js"></script>

    <!-- Bootstrap CDN -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>

    <!-- URL: https://v4-alpha.getbootstrap.com/examples/blog/blog.css -->
    <style>
        /*
 * Globals
 */

        @media (min-width: 48em) {
            html {
                font-size: 18px;
            }
        }

        body {
            font-family: Georgia, "Times New Roman", Times, serif;
            color: #555;
        }

        h1, .h1,
        h2, .h2,
        h3, .h3,
        h4, .h4,
        h5, .h5,
        h6, .h6 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: normal;
            color: #333;
        }


        /*
         * Override Bootstrap's default container.
         */

        #blog.container {
            max-width: 60rem;
        }


        /*
         * Masthead for nav
         */

        .blog-masthead {
            margin-bottom: 3rem;
            background-color: #428bca;
            -webkit-box-shadow: inset 0 -.1rem .25rem rgba(0,0,0,.1);
            box-shadow: inset 0 -.1rem .25rem rgba(0,0,0,.1);
        }

        /* Nav links */
        /*        #blog.nav-link {
                    position: relative;
                    padding: 1rem;
                    font-weight: 500;
                    color: #cdddeb;
                }
                #blog.nav-link:hover,
                #blog.nav-link:focus {
                    color: #fff;
                    background-color: transparent;
                }

                !* Active state gets a caret at the bottom *!
                #blog.nav-link.active {
                    color: #fff;
                }
                #blog.nav-link.active:after {
                    position: absolute;
                    bottom: 0;
                    left: 50%;
                    width: 0;
                    height: 0;
                    margin-left: -.3rem;
                    vertical-align: middle;
                    content: "";
                    border-right: .3rem solid transparent;
                    border-bottom: .3rem solid;
                    border-left: .3rem solid transparent;
                }*/


        /*
         * Blog name and description
         */

        .blog-header {
            padding-bottom: 1.25rem;
            margin-bottom: 2rem;
            border-bottom: .05rem solid #eee;
        }
        .blog-title {
            margin-bottom: 0;
            font-size: 2rem;
            font-weight: normal;
        }
        .blog-description {
            font-size: 1.1rem;
            color: #999;
        }

        @media (min-width: 40em) {
            .blog-title {
                font-size: 3.5rem;
            }
        }


        /*
         * Main column and sidebar layout
         */

        /* Sidebar modules for boxing content */
        .sidebar-module {
            padding: 1rem;
            /*margin: 0 -1rem 1rem;*/
        }
        .sidebar-module-inset {
            padding: 1rem;
            background-color: #f5f5f5;
            border-radius: .25rem;
        }
        .sidebar-module-inset p:last-child,
        .sidebar-module-inset ul:last-child,
        .sidebar-module-inset ol:last-child {
            margin-bottom: 0;
        }


        /* Pagination */
        .blog-pagination {
            margin-bottom: 4rem;
        }
        .blog-pagination > .btn {
            border-radius: 2rem;
        }


        /*
         * Blog posts
         */

        .blog-post {
            margin-bottom: 4rem;
        }
        .blog-post-title {
            margin-bottom: .25rem;
            font-size: 2.5rem;
        }
        .blog-post-meta {
            margin-bottom: 1.25rem;
            color: #999;
        }
    </style>
</head>
<title>About Our Project</title>
<body>
<div class="blog-header">
    <div class="container">
        <h1 class="blog-title">N-Queen Puzzle Solver</h1>
        <p class="lead blog-description">Our Report</p>
    </div>
</div>
<div class="container" id="blog">
    <div class="row">
        <div class="col-sm blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">Our AI Project</h2>
                <p class="blog-post-meta">December 5, 2018 by <strong>Henry Reeves and Ruben Ortiz</strong></p>
                <p>Before we get into on how our algorithm works, I would like to give a special thanks to our AI professor, Minhua Huang, for giving us more time
                 than what was originally required.</p>
                <p>Today, I would like to discuss how we went about solving the N-Queen Puzzle problem, how to setup our project, and what we could do to
                improve our algorithm. If you are not sure what this puzzle is, I'll explain it briefly. Basically, the goal is to setup the chessboard in a
                way where no queen can attack the other (N = number of queens). For this problem, there are only a finite amount of solutions depending on the number
                 of queens given. Our scripts purpose, is to find all of these solutions and display basic statistical data.</p>
                <p>The goal of this project is to solve this puzzle with the <strong>Genetic Algorithm</strong>. However, our ultimate goal is to continue to
                 optimize our algorithm and setup a website where a user could interact with this puzzle to test our the Genetic Algorithm on the N-Queens Puzzle problem.</p>
                <hr>
                <h3>The Genetic Algorithm</h3>
                <p>Whenever we were deciding what our project was going to be, we wanted it to be something that we would continue. For this reason, Laila and I spoke to Bryan Gillis (Lab Coordinator at S{Q}L) and Sam Allred (Graduate Research Assistant Lead Developer and Software Architect at S{Q}L) about
                    how we could possibly incorporate our class project into the work we do in the lab. During this discussion, Laila and I described what the project needs to incorporate, which is some
                    form of image processing and human computer interaction. At first, it seemed like we wouldn't be able to come up with an idea that involved our lab.</p>
                <p>One of the ideas mentioned was a
                    creating a virtual reality experience where the user could load a map and hold it in their hands. However, we quickly decided against this because our team had no experience with that side
                    of computer science, we needed to do something we were familiar with.</p>
                <p>After the virtual reality idea was tossed aside, a few days passed, we were hoping to eventually come up with something. Then one day, while Laila and I were discussing a bug issue, we
                    finally thought of an idea that would lead us to our real project. What if we could read the text from our historical maps?</p>
                <h3>The Original Plan</h3>
                <p>Reading text from our historical documents sounded like a great idea, but it didn't sound like it was enough to be a full-fledged project. We were debating about coming up with a whole new idea. Why not do something simple? Not too long afterwards, we came up with our real project.
                    The idea is to read the historical documents, save the text, and then determine what it means.</p>
                <h3>Cataloging Historical Maps</h3>
                <p>At the Spatial Query Lab (S{Q}L), the cataloging process is simple and done through our in-house website, Bandocat. In short, Bandocat is a website that our lab uses and it allows us to manage these documents and publish them to the Texas Digital Library (TDL). Before we continue to discuss
                    our project, I must explain the cataloging of these documents.</p>
                <p>Cataloging these historical documents is not difficult, but it can be very tedious. There is a webpage on Bandocat that allows our employees to catalog these documents. Basically, the catalogers fill out the metadata on the document they are uploading. The metadata includes
                    the document title, subtitle, author(s) of the map, points of interest, does it have a coast, is there a north arrow, etc. If you want to see all the metadata that our catalogers fill out by looking at the document, please navigate to the <a href="../Catalog/">cataloging page</a>.
                    Once they have filled out the required fields, they then upload the document onto our SQL database by clicking the button "Upload".</p>
                <h3>Why Change the Process?</h3>
                <p>By looking at the cataloging page, you can feel the gravity of how much work it is to catalog a document. In the traditional way, a cataloger in our lab has opened the document on one monitor and then the cataloging page on the other. Our ultimate goal is to automate this entire process.
                    At the very least, make it faster and less tedious as possible. We understand that doing the same thing over and over is going to eventually be tedious, but there has got to be a better way to do it.</p>
                <p>Below are issues that we want to correct:</p>
                <ul>
                    <li><strong>Limit the two windows to catalog to one.</strong> This should save time from not having to navigate between each window.</li>
                    <li><strong>Instead of typing, click a button!</strong> If the cataloger finds the metadata they are looking for, it would be much faster to click a button than having to type it out.</li>
                    <li><strong>Rework Bandocat's user interface to a simple, but modern web page.</strong> You might be thinking "Can it really make that much of a difference?" Honestly, it can. Think about it, do you like coming home from the day to a clean home or a messy one?</li>
                </ul>
                <h3>The Results</h3>
                <p>All in all, we have changed this project a couple times. In the beginning, we thought we were going to be running this website on a node.js server to run Tesseract.js. Afterwards, we thought we were going to write a console script using
                    Scene Text Detection <a href="../SceneTextDetection/">(see our script in action here)</a> to crop our images and then give it to tesseract.js or a command prompt version of it. Oh, did I mention we were even going to use natural language processing to decide what the metadata was?</p>
                <p>After many issues and struggling, we ended up with a much
                    simpler solution. Have the user crop out the images in a canvas and let them choose what it is (in terms of metadata). Afterwards, upload these images to the server (XAMPP), run tesseract on each one. Create an array and assign the key as the value of what the text is supposed to be.
                    Last but not least, move the user to the cataloging page and fill out the fields as much as possible!</p>
                <h3>Our Team</h3>
                <h6>Ruben Ortiz</h6>
                <p>Systems Programming Major at Texas A&M Corpus Christi</p>
                <h6>Henry (Court) Reeves</h6>
                <p>Undergraduate Research Assistant Developer at S{Q}L and Systems Programming Major at Texas A&M Corpus Christi</p>
                <h3>Conclusion</h3>
                <p>The project itself is not complete. In my opinion, the current state of it is not even an alpha build. In reality, what we created is a framework that will be built upon in the future by our team or programmers at S{Q}L. </p>
            </div><!-- /.blog-post -->
            <!-- How to setup project -->
            <div class="blog-post">
                <h2 class="blog-post-title">Setting Up the Project</h2>
                <p class="blog-post-meta">Watch this video to see how to setup the server and project files: <a href="https://www.youtube.com/watch?v=z886g6wzMpU&t=2s">XAMPP Installation Guide by Henry Reeves</a></p>
                <h3>Links to Stuff You Will Need</h3>
                <p><strong>I highly recommend that you use a computer that runs off of the Windows operating system.</strong> We cannot guarantee that any of this will work on another operating system.</p>
                <ol>
                    <li>
                        <a href="https://www.apachefriends.org/download.html">XAMPP</a> which is our webserver (Only need to run the Apache server)
                    </li>
                </ol>
                <h2>Getting Started</h2>
                <p>At this point, you are only seeing this page for one of three reasons:</p>
                <ol>
                    <li>You have already installed XAMPP and are running a local Apache server</li>
                    <li>We are hosting this on a website that is accessible via the internet</li>
                    <li>You went into the project files and just ran this through a browser</li>
                </ol>
                <p>Either way, if its the first or third reason, I am here to help you out! By the way, I created a video for my software engineering class a while back that will show you how to install XAMPP and move the project files to the correct location.
                    I did this because personally, I follow along must easier through watching a video of some kind. Anyways, lets make sure that everything is working properly so that you can run our project!</p>
                <h2>Downloading and Running XAMPP</h2>
                <p>Installing and running XAMPP is simple. First of all, click this link <a href="https://www.apachefriends.org/download.html">here</a> to download the version of XAMPP for you computer (I choose the very first option for Windows operating system).
                    Install the software and then run the XAMPP control panel. Once its running, make sure you click "start" on the Apache server. It looks like this:</p>
                <img src="xampp.JPG">
                <p>Once the Apache server is running, move the project files to this directory: C:\xampp\htdocs. Your htdcos folder should look like this:</p>
                <img src="directory.JPG">
                <p><strong>Note:</strong> The Apache server must be running before you can open the website. Once it is running click <a href="http://localhost/HCIProject/Forms/About/">here</a> or copy and paste this link in your browser: http://localhost/HCIProject/Forms/About/</p>
            </div>
        </div>
        <!-- About -->
<!--        <div class="col-sm-3 offset-sm-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset border rounded">
                <h4>About S{Q}L</h4>
                <p>We have many projects in our lab (S{Q}L in the Conrad Blucher Institute), but the largest one is the Ed Rachel Map Scanning project.
                    The goal of the Ed Rachel project is to scan and catalog historical documents dating back to the 19th century and upload these to a database. Once in the
                    database, we can then upload these documents to the Texas Digital Library for public use.</p>
            </div>
        </div>-->
    </div> <!-- Row -->
</div>
<footer class="blog-footer text-center">
    <p>Please email me if you are having issues running our project at <strong>hreeves@islander.tamucc.edu</strong></p>
    <p>Styling for our website powered by <a href="https://getbootstrap.com">Bootstrap</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
    <p><a href="../8Queens/">Back to N-Queens Puzzle Solver</a></p>
</footer>
</body>
</html>

