<?php

interface ShareLink
{
    /**
     * @param string $recipient
     * @param string $subject
     * @param string $message
     * @return void
     **/
    public function share($recipient, $subject, $message, $pdfContent = null, $pdfFilename = null);
}

/**
 * Share link to user
 * @param ShareLink $shareMethod
 * @param string $recipient
 * @param string $subject
 * @param string $message
 * @return void
 **/
function shareLinkToUser($shareMethod, $recipient, $subject, $message, $pdfContent = null, $pdfFilename = null)
{
    $shareMethod->share($recipient, $subject, $message, $pdfContent, $pdfFilename);
}