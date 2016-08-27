#!/usr/bin/perl
use strict;
use warnings;

my $brew;

my @brew_installs = qw( 
    autoconf    automake    binutils    boost   bzip2   curl    curl    curl-ca-bundle      curl-ca-bundle      cyrus-sasl2     db48    flex    gdbm    gdbm    gettext            glib2    gnutls      gperf   help2man    icu     jansson     jpeg    kerberos5   libffi      libgcrypt   libgpg-error    libiconv    libidn      libpng      libtasn1    lzo2      m4    miniupnpc   ncurses     openssl     ossp-uuid   p5-locale-gettext   p5.12-locale-gettext    perl5   perl5.12    perl5.12    pkgconfig   pv      qemu    qrencode             readline   texinfo     xz      yasm    zlib )
;

&array_cracker();

           sub array_cracker(){
            foreach(@brew_installs){
               print $_; 
                  $brew = `brew install $_`;
                     print $brew;
                       }   
                       }   


