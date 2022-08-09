<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <?= $this->Html->link(__('New Contacts'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contacts') ?></h3>
    <div class="box">
        <div class="box-body table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><?= ('id') ?></th>
                    <th><?= ('first_name') ?></th>
                    <th><?= ('last_name') ?></th>
                    <th><?= ('email') ?></th>
                    <th><?= ('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $this->Number->format($contact['hs_object_id']) ?></td>
                        <td><?= h($contact['firstname']) ?></td>
                        <td><?= h($contact['lastname']) ?></td>
                        <td><?= h($contact['email']) ?></td>
                        <td><?= h($contact['lastmodifieddate']) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $contact['hs_object_id']]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact['hs_object_id']]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact['hs_object_id']], ['confirm' => __('Are you sure you want to delete # {0}?', $contact['hs_object_id'])]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
