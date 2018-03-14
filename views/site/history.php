<?php
$this->title = 'History';
?>
<div class="site-index">

    <div class="body-content">
	
		<div class="row">
            <h2>History</h2>
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
							<th></th>
                            <th>Login</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach($history as $item): ?>
                        <tr>
                            <?if($item->user_id==Yii::$app->user->identity->id):?>
								<td>-</td>
								<td><?=$item->receiver->username?></td>
							<?else:?>
								<td>+</td>
								<td><?=$item->sender->username?></td>
							<?endif;?>
													
                            <td><?=$item->amount?></td>
                            <td><?=$item->date?></td>
                        </tr>
                        <? endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
