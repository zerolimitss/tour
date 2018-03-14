<?php
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <h2>Users list</h2>
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Login</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach($users as $item): ?>
                        <tr>
                            <td><?=$item->username?></td>
                            <td><?=$item->balance?></td>
                        </tr>
                        <? endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
