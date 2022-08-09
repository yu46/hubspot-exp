<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $contact
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $contact->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="users view large-9 medium-8 columns content">
    <h3><?= h($contact->hs_object_id) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('First Name') ?></th>
                <td><?= h($contact->firstname) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Last Name') ?></th>
                <td><?= h($contact->lastname) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Email') ?></th>
                <td><?= h($contact->email) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($contact->hs_object_id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($contact->createdate) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($contact->lastmodifieddate) ?></td>
            </tr>
        </table>
    </div>
</div>
