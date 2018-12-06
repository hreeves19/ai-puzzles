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
                <p>In nature the fittest organisms are commonly the ones that live on and get the chance to reproduce offspring. If this process is followed, every generation after will theoretically develop better features than the last generation to improve their living conditions in their environment.  This process has become known as evolution and is much more complicated and time consuming than you would think</p>
                <p>Let’s consider two cells that each have a pair of chromosomes.  Chromosomes, as we know, are the carriers of genetic material and traits.  Therefore, when two parent cells come together both of their chromosomes mix which may result in an offspring that contains random characteristics from both cell one and cell two.  Furthermore,  since chromosomes hold genetic traits mixing them creates entirely new genetic sequences and this ensures genetic diversity.  This entire process of fusing chromosomes is actually referred to as crossover.  In some rare cases mutation can also be an effect of the crossover process.</p>
                <p>A common example of mutation is cancer, however, mutations could have positive results as well.  Mutation is necessary for evolution and is the way it started by mutating single-celled organisms into multi-celled organisms. So through this process new generations are produced with traits similar to both parent cells and then that generation can then find other cells to produce the next generation and so on.</p>
                <p>Now that we have seen the biology of how this process works, lets see how we implemented this into solving the puzzle!</p>
                <h3>Our System</h3>
                <p>Our system is has two main components too it, which are the front end and the back end. Basically, we are following the same system architecture that pretty much all modern websites use.
                 For our styling of our web pages, we are using a css framework called <a href="https://getbootstrap.com/">Bootstrap</a>. Additionally, the web server we are using is called xampp, which is
                 just running an Apache Server.</p>
                <p>Let's discuss the a top-down view of how our system runs. First of all, the Apache server must be running, or nothing will work. On the client-side (the browser), we have the user enter
                information on how they want our script to run. Once they have filled out the form, they can then press a button to start the script.</p>
                <p>Once the button is submitted, an <strong>AJAX</strong> call to the server is sent. The server will then direct the call to the address that
                is specified in the URL of the ajax call. Once there, we run <strong>exec()</strong> with the command to run our php script (we pass the user's
                input as arguments through argv). In other words, the php script that is trying to solve the puzzle is running as its own separate process on our
                Apache server. Once the script terminates, it returns to where it was called and the server then sends the response, which then creates the charts
                 and displays the chest boards. </p>
                <h3>The Results</h3>
                <p>We have primarily been testing for 8 queens, but the system also runs with any number. However, we strict user input to only allow
                 N (the number of queens) to be than 3 because the puzzle is insolvable for N = 1, 2, or 3.</p>
                <p>In my personal opinion, more mutation that I have added to the system, produced better results. Also, we added a mechanic to the
                alogorithm that is, interesting. Basically, the longer the script takes to find the solution, the higher the chance that the current
                 population will be wiped out and reinitialized. The reason I tailored this is because without it, the population will merge to be the
                 same. Unfortunately, not even mutation was able to handle it. Although, we have only seen the population merge to be the same with
                Adam and Eve selector.</p>
                <h3>Conclusion</h3>
                <p>At first, this algorithm was very difficult for us to understand and implement. However, we eventually were able to figure everything out! Also,
                the way our program reads the chromosome sequences is backwards compared to the traditional way. Basically, instead of starting from the bottom of the
                 board and counting up, start at the very top and count down (starting your counting with 0). Also, it is still from left to right.</p>
                <p>Anyways, if you have any problems or issues running our program, please don't hesitate to email me at hreeves@islander.tamucc.edu. Please follow
                the installation guide below to get started!</p>
                <h3>The Development Team</h3>
                <h6>Ruben Ortiz</h6>
                <p>Systems Programming Major at Texas A&M Corpus Christi</p>
                <h6>Henry (Court) Reeves</h6>
                <p>Undergraduate Research Assistant Developer at S{Q}L and Systems Programming Major at Texas A&M Corpus Christi</p>
            </div><!-- /.blog-post -->
            <!-- How to setup project -->
            <div class="blog-post">
                <h2 class="blog-post-title">Setting Up the Project</h2>
                <p class="blog-post-meta">Watch this video to see how to setup the server and project files: <a href="https://www.youtube.com/watch?v=z886g6wzMpU&t=2s">XAMPP Installation Guide by Henry Reeves</a></p>
                <h3>Links to Stuff You Will Need</h3>
                <p><strong>I highly recommend that you use a computer that runs off of the Windows operating system.</strong> We cannot guarantee that any of this will work on another operating system.</p>
                <ol>
                    <li>
                        <a href="https://www.apachefriends.org/download.html">XAMPP</a> which is our webserver (Only need to run the Apache server).
                    </li>
                    <li>
                        <a href="https://www.youtube.com/watch?v=iW0B9NTId2g">Php for Windows</a>, our project requires that php is stored on the user's computer. It's because we use an <strong>exec()</strong> to start the script. You can actually
                        see the script running in task manager. If there are any issues or you want to stop it, you can just it through task manager.
                    </li>
                </ol>
                <h2>Getting Started</h2>
                <p>At this point, you are only seeing this page for one of two reasons:</p>
                <ol>
                    <li>You have already installed XAMPP and are running a local Apache server</li>
                    <li>We are hosting this on a website that is accessible via the internet</li>
                </ol>
                <p>Either way, if its the first or second reason, I am here to help you out! By the way, I created a video for my software engineering class a while back that will show you how to install XAMPP and move the project files to the correct location.
                    I did this because personally, I follow along must easier through watching a video of some kind. Anyways, lets make sure that everything is working properly so that you can run our project!</p>
                <h2>Downloading and Running XAMPP</h2>
                <p>Installing and running XAMPP is simple. First of all, click this link <a href="https://www.apachefriends.org/download.html">here</a> to download the version of XAMPP for your computer (I choose the very first option for Windows operating system).
                    Install the software and then run the XAMPP control panel. Once its running, make sure you click "start" on the Apache server. It looks like this:</p>
                <img src="xampp.JPG">
                <p>Once the Apache server is running, move the project files to this directory: C:\xampp\htdocs. Your htdcos folder should look like this:</p>
                <img src="directory.JPG">
                <p><strong>Note:</strong> The Apache server must be running before you can open the website. Once it is running click <a href="http://localhost/ai-puzzles/Forms/8Queens/">here</a> or copy and paste this link in your browser: http://localhost/ai-puzzles/Forms/About/</p>
                <h2>Configuring XAMPP</h2>
                <p>Our script needs to have enough memory allocated to it and be able to run for an infinite about of time due to the complexity of solving
                this type of puzzle. Please follow these steps below.</p>
                <ol>
                    <li>Open up XAMPP control panel once again</li>
                    <li>Once its opened, click on config for the Apache server (should be in the first row)</li>
                    <li>Once you click on it, a list should pop up. Click on the file: php.ini and let it open in notepad (or any text editor)</li>
                    <li>Leave this window open, open this link <a href="../../Log/configuration_of_xampp.html">here</a> as a new tab</li>
                    <li>Use ctrl+a to select everything on the page of the new tab you opened, then use ctrl+c to copy the text</li>
                    <li>Now go to the window you opened early, whichever editor you opened it with. Then ctrl+a on this window to highlight all
                     the text, then ctrl+v to overwrite this text file</li>
                    <li>Last but not least, save the file in the text editor you are on. Then restart the Apache server on XAMPP and you are good to go!</li>
                </ol>
                <p>If you are wondering why you had to go through that, its because now the script will be running with the same configuration as ours! Not
                    changing your php.ini on XAMPP will cause unexpected behavior on our script. In other words, it will not run properly.</p>
                <h3>References</h3>
                <p>While we were trying to understand how this algorithm works, this is the website we found that explains this really well! Addtionally,
                    some of our ideas and thoughts come from this location. You should check it out if you are interested in this topic. Click <a href="https://kushalvyas.github.io/gen_8Q.html">here</a> to visit their page!</p>

            </div>
        </div>
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

