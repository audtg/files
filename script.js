jQuery(function () {

    var articul = jQuery('.product_articul').attr('data-articul');

    jQuery.get('/include/getCertificates.php', {matId: articul}, function (response) {
        var data = JSON.parse(response);
        console.log(data.certCount);
        if (data.certCount > 0) {
            jQuery('#materialsForLoad').css('display', 'block');
            data.certInfo.forEach(function (item) {
                jQuery('#materialsForLoadList')
                    .append(jQuery('<li style="list-style-type: none; background: none;">')
                        .append(jQuery('<a style="float: left; margin-right: 15px; margin-top: 10px;" class="load-a" href="/include/getCertificateDs.php?matId='+articul+'&mcfId=' + item.mcfId + '&mcfCode=' + item.mcfCode + '">')
                                .append(jQuery('<img>').attr({
                                    src: '/bitrix/templates/b2b_2013/components/bitrix/catalog/catalog/bitrix/catalog.element/.default/0072c5.png',
                                    alt: 'Загрузить',
                                    title: 'Загрузить'
                                }))
                        )
                        .append(jQuery('<div style="float: left; class="file _jpg">')
                            .append(jQuery('<a style="float: left;" class="cert-a file _jpg" href="#" data-mcfid="' + item.mcfId + '">')
                                    .append(jQuery('<i class="pic"></i>')
                                    )
                                    .append(jQuery('<span>' + item.mcfCode + '</span>')
                                    )
                                    .append(jQuery('<small class="misc">(' + item.mcfDateFrom + ' - ' + item.mcfDateTo + ')</small>')
                            )
                        )
                        .append(jQuery('<span>').css('padding-left', '30px').html(item.mcfProd))
                        )
                        .append('<div style="clear: both;">')
                    )
                ;
            });
        }


        jQuery('.cert-a').on('click', function () {
            $('#loadedCert').remove();
            var mcfId = jQuery(this).attr('data-mcfid');
            var loadedImg = $('#loadedCert');
            if (loadedImg.length) {
                loadedImg.find('a').colorbox({inline: true, open: true, rel: 'certificate'});
            }
            else {
                var productId = $(this).attr('data-productid');
                ShowWhaitWindow();
                $.getJSON("/include/getCertificatesDsIds.php", {mcfId: mcfId}, function (response) {
                    if (!response.err) {
                        var divObj = $('<div id="loadedCert"></div>').css('display', 'none');
                        var k = 0;
                        $.each(response.dsId, function (index) {
                            $('<a class="certificateHidden" rel="certificate" href="#certivicateImg' + index + '"></a>').appendTo(divObj);
                            $('<div id="certivicateImg' + index + '" onClick="$.colorbox.next();">' +
                                '<img width="500px" src="/include/getCertificateDsById.php?dsId=' + this + '">' +
                                '</div>').appendTo(divObj);
                            k++;
                        });
                        divObj.appendTo(document.body);
                        divObj.find('img').last().bind('load', function () {
                            HideWhaitWindow();
                            divObj.find('a').colorbox({inline: true, open: true, rel: 'certificate'});
                        });
                    }
                    else {
                        var n = noty({
                            text: response.err,
                            type: 'alert',
                            dismissQueue: true,
                            layout: "center",
                            theme: 'defaultTheme',
                            buttons: [
                                {
                                    addClass: 'btn btn-danger', text: 'Закрыть', onClick: function ($noty) {
                                    $noty.close();
                                }
                                }
                            ]
                        });
                        HideWhaitWindow();
                    }
                });
            }
            return false;
        });


        jQuery('.load-a').on('click', function () {
        });


    });


});

