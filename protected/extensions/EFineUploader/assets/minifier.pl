#!/usr/bin/perl
use JavaScript::Minifier qw(minify);
open(INFILE, 'jquery.fineuploader-3.4.1.js') or die;
open(OUTFILE, '>jquery.fineuploader-3.4.1.min.js') or die;
minify(input => *INFILE, outfile => *OUTFILE, stripDebug => 1) ;
close(INFILE);
close(OUTFILE);
