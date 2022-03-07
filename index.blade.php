<!DOCTYPE html>
<html lang=”ja”>

<head>
  <meta charset=”utf-8″>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name=”viewport” content=”width=device-width, initial-scale=1″>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <div style="padding:10px">
    <canvas id="canvas" width="500" height="200" style="border:1px solid #000000;">
    </canvas>
    <div style="padding-top:10px">
      <button type="button" id="clear">リセット</button>
      <button type="button" onclick="chgImg()" value="1">画像変換</button>
      <button type="button" id="file_upload_btn" value="2">画像アップロード</button>
    </div>
    <h3>画像出力</h3>
    <div id="img-box"><img id="newImg"></div>
  </div>
  <script src="{{ asset('/js/canvasevent.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#file_upload_btn').on('click', function() {

        //ajaxでのcsrfトークン送信
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        // Canvasのデータをbase64でエンコードした文字列を取得
        var canvasData = $('canvas').get(0).toDataURL();
        // 不要な情報を取り除く
        canvasData = canvasData.replace(/^data:image\/png;base64,/, '');

        //フォームデータを作成する
        var form = new FormData();
        //フォームデータにアップロードファイルの情報追加
        form.append("file", canvasData);
        $.ajax({
          type: "POST",
          url: "{{ route('ajax_file_upload') }}",
          data: form,
          processData: false,
          contentType: false,
          success: function(response) {},
          error: function(response) {}
        });
      })
    });
  </script>
</body>

</html>
