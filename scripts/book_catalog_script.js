let btnClass = null;
let btn = null;
let text = null;
$.each(jsParams,function(index, book){
    if(book.dateEnd)
    {
        btnClass = " btn-danger disabled";
        text = "Книга занята до " + book.dateEnd;
    }else
    {
        btnClass = " btn-success";
        text = "Забронировать";
    }
    btn = $('#'+book.idbook+'')[0];
    btn.className += btnClass;
    btn.innerHTML = text;
});
$("#accept_filter").on('click', function (e) {
    let year = $("#year").val();
    let publisher_id = $("#publisher").val();
    let author_id = $("#author").val();
    let rating = $("#rating").val();

    let url = "/filter/?";
    if(year)
    {
        url += "year=" + year + "&";
    }
    if(publisher_id > 0)
    {
        url += "publisher_id=" + publisher_id+ "&";
    }
    if(author_id > 0)
    {
        url += "author_id=" + author_id+ "&";
    }
    if(rating)
    {
        url += "rating=" + rating+ "&";
    }
    if(url !== "/filter/?")
    {
        window.location.href = url;
    }
});
$('.book_add').on('click', function (e) {
    let book_id = e.target.id;

    $.ajax({
        url: '/book/get/',
        method: 'post',
        dataType: 'json',
        data: {
            book_id: book_id
        },
        success: function(data){
            if(data.status === 'REDIRECT')
            {
                window.location.href = '/auth/';
            }else if(data.status === 'OK')
            {
                e.target.classList.remove('btn-success');
                e.target.classList.add('btn-danger');
                e.target.classList.add('disabled');
                e.target.innerHTML = "Книга занята до " + data.dateEnd;
            }
        }
    });
});