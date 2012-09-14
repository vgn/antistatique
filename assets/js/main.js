/*
 * Antistatique.net
 * Javascript file
 */

jQuery(function($) {
    $('#newsletter_form').submit(function (e) {
        var $form = $(this);
        $form.find('.alert').hide();
        e.preventDefault();
        $.getJSON(
            this.action + "?callback=?",
            $(this).serialize(),
            function (response) {
                if (200 === response.Status) {
                    $form.find('.alert-success').show();
                    $('input[type="text"]','#newsletter_form').val('');
                } else {
                    $form.find('.alert-error').show();
                }
            }
        );
    });

    // twitter
    var twitterUsername = $('#tweet').attr('data-twitter-username');
    var twitterHashtag = $('#tweet').attr('data-twitter-hashtag');
    $.getJSON(
        'http://search.twitter.com/search.json?q='+encodeURIComponent(twitterHashtag)+'+from:'+twitterUsername+'&rpp=5&include_entities=true&with_twitter_user_id=true&result_type=mixed&callback=?',
        function (response) {
            var results = response.results || [];
            var tweet;
            var tweetUrl;
            var dateUserFriendly;
            var linkify = function (text) {
                var exp = /(\b(https?|ftp|file):\/\/[\-A-Z0-9+&@#\/%?=~_|!:,.;]*[\-A-Z0-9+&@#\/%=~_|])/ig;
                return text.replace(exp,"<a href='$1'>$1</a>");
            };

            var removeHashtag = function (text) {
                return text.replace(twitterHashtag, '');
            };

            if (results.length > 0) {
                tweet = results[0];
                tweetUrl = 'http://twitter.com/'+twitterUsername+'/status/'+tweet.id_str; // strange, no way to get it from response...
                dateUserFriendly = moment(tweet.created_at).format('D MMM YYYY, H:m');

                $('#tweet')
                    .find('blockquote').html('<span>«</span> ' + linkify(removeHashtag(tweet.text)) + ' <span>»</span>').attr('cite', tweetUrl).end()
                    .find('time').attr('datetime', tweet.created_at).end()
                    .find('time a').html(dateUserFriendly).attr('href', tweetUrl)
                ;

                if (typeof window.twttr !== "undefined") {
                    twttr.anywhere(function (T) {
                        T("#tweet blockquote").hovercards();
                    });
                }
            }
        }
    );
});
