<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api', name: 'api_')]
class AWSController extends AbstractController
{
    #[Route('/put_signed_url', name: 'sign_url')]
    public function index(Request $request): Response
    {
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => 'eu-north-1',
            'credentials' => [
                'key' => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ],
        ]);

        $bucketName = $_ENV['S3_BUCKET_NAME'];
        $fileName = $request->query->get('file-name');
        $fileType = $request->query->get('file-type');
        $fileSize = $request->query->get('file-size');

        $command = $s3Client->getCommand('PutObject', [
            'Bucket' => $bucketName,
            'Key' => $fileName,
            'ContentType' => $fileType,
            'ContentLength' => $fileSize
        ]);

        $signedUrl = $s3Client->createPresignedRequest($command, '+20 minutes')->getUri();

        return new JsonResponse(['signedUrl' => $signedUrl]);
    }

    #[Route('/get_signed_url', name: 'get_sign_url')]
    public function getSignedUrl(Request $request): Response
    {
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => 'eu-north-1',
            'credentials' => [
                'key' => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ],
        ]);

        $bucketName = $_ENV['S3_BUCKET_NAME'];
        $fileName = $request->query->get('file-name');
        $fileType = $request->query->get('file-type');

        $command = $s3Client->getCommand('GetObject', [
            'Bucket' => $bucketName,
            'Key' => $fileName,
            'ContentType' => $fileType,
        ]);

        $signedUrl = (string)$s3Client->createPresignedRequest($command, '+20 minutes')->getUri();

        return new JsonResponse(['signedUrl' => $signedUrl]);
    }
}