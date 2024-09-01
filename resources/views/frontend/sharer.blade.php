<style>
    a.linkedin{
        background: #0077b5;
    }

    a.google-plus{
        background: #dc483c;
    }
</style>
<a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{\Illuminate\Support\Facades\Request::fullUrl()}}', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
   href="javascript:void(0);" class="facebook" title="Share on Facebook"><i
            class="fa fa-facebook"></i></a>
<a onclick="window.open('https://twitter.com/intent/tweet?via=Malaya-Holidays;text={{$destination->title}};url={{\Illuminate\Support\Facades\Request::fullUrl()}}', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
   href="javascript:void(0);" class="twitter" title="Share on Twitter"><i
            class="fa fa-twitter"></i></a>
<a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&amp;title={{$destination->title}}&amp;url={{\Illuminate\Support\Facades\Request::fullUrl()}}', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
   href="javascript:void(0);" class="linkedin" title="Share on LinkedIn"><i
            class="fa fa-linkedin-square"></i></a>
<a href="https://plus.google.com/share?url={{\Illuminate\Support\Facades\Request::fullUrl()}}"
   onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"
   class="google-plus" title="Share by email"><i class="fa fa-envelope"></i></a>