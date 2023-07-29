<x-app-layout>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル"/>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="・どの講義でも必ずパソコンを使うため、バッテリーの持ちが悪くて大変"></textarea>
            </div>
            <div class="image">
                <h2>写真を入れる予定地</h2>
            </div>
            <div class="os">
                <h2>osを選択してください</h2>
                <input type="radio" name="post[os]" value="Mac" id="mac">
                <label for="option1">Mac</label>
                <input type="radio" name="post[os]" value="Windows" id="Windows" >
                <label for="option2">Windows</label>
            </div>
            <div class="cost">
                <h2>値段を選択してください</h2>
                <input type="radio" name="post[cost]" value="8万円以下" id="cost1">
                <label for="option1">8万円以下</label>
                <input type="radio" name="post[cost]" value="8万円~12万円" id="cost2" >
                <label for="option2">8~12万円</label>
                <input type="radio" name="post[cost]" value="12万円以上" id="cost3" >
                <label for="option3">12万円以上</label>
            </div>
            <div class="weight">
                <h2>重さを選択してください</h2>
                <input type="radio" name="post[weight]" value="1.5kg以下" id="weight1">
                <label for="option1">1.5kg以下</label>
                <input type="radio" name="post[weight]" value="1.5~2kg" id="weight2" >
                <label for="option2">1.5~2kg</label>
                <input type="radio" name="post[weight]" value="2kg以上" id="weight3" >
                <label for="option3">2kg以上</label>
            </div>
            <div class="battery">
                <h2>バッテリーの持続時間を選択してください（充電をしないで使える時間をお答えください）</h2>
                <input type="radio" name="post[battery]" value="3時間以下" id="battery1">
                <label for="option1">3時間以下</label>
                <input type="radio" name="post[battery]" value="3時間~6時間" id="battery2" >
                <label for="option2">3時間~6時間</label>
                <input type="radio" name="post[battery]" value="6時間以上" id="battery3" >
                <label for="option3">6時間以上</label>
            </div>
            
            <input type="hidden" name="post[user_id]" value="{{ $user->id }}">
            
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a class="ml-2 px-4 py-2 bg-gray-200 rounded" href="/">戻る</a>
        </div>
</x-app-layout>