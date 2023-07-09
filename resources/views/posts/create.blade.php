<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル"/>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。"></textarea>
            </div>
            <div class="image">
                <h2>写真を入れる予定地</h2>
            </div>
            <div class="os">
                <h2>osを選択してください</h2>
                <input type="radio" name="post[os]" value="os1" id="os1">
                <label for="option1">オプション1</label>
                <input type="radio" name="post[os]" value="os2" id="os2" >
                <label for="option2">オプション2</label>
            </div>
            <div class="cost">
                <h2>costを選択してください</h2>
                <input type="radio" name="post[cost]" value="cost1" id="cost1">
                <label for="option1">オプション1</label>
                <input type="radio" name="post[cost]" value="cost2" id="cost2" >
                <label for="option2">オプション2</label>
            </div>
            <div class="weight">
                <h2>weightを選択してください</h2>
                <input type="radio" name="post[weight]" value="weight1" id="weight1">
                <label for="option1">オプション1</label>
                <input type="radio" name="post[weight]" value="weight2" id="weight2" >
                <label for="option2">オプション2</label>
            </div>
            <div class="battery">
                <h2>batteryを選択してください</h2>
                <input type="radio" name="post[battery]" value="battery1" id="battery1">
                <label for="option1">オプション1</label>
                <input type="radio" name="post[battery]" value="battery2" id="battery2" >
                <label for="option2">オプション2</label>
            </div>
            
            <input type="hidden" name="post[user_id]" value="{{ $user->id }}">
            
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>