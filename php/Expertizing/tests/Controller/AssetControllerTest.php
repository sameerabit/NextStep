<?php

namespace App\Test\Controller;

use App\Entity\Asset;
use App\Repository\AssetRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AssetControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AssetRepository $repository;
    private string $path = '/asset/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Asset::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Asset index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'asset[title]' => 'Testing',
            'asset[phoneNumber]' => 'Testing',
            'asset[description]' => 'Testing',
            'asset[userId]' => 'Testing',
        ]);

        self::assertResponseRedirects('/asset/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Asset();
        $fixture->setTitle('My Title');
        $fixture->setPhoneNumber('My Title');
        $fixture->setDescription('My Title');
        $fixture->setUserId('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Asset');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Asset();
        $fixture->setTitle('My Title');
        $fixture->setPhoneNumber('My Title');
        $fixture->setDescription('My Title');
        $fixture->setUserId('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'asset[title]' => 'Something New',
            'asset[phoneNumber]' => 'Something New',
            'asset[description]' => 'Something New',
            'asset[userId]' => 'Something New',
        ]);

        self::assertResponseRedirects('/asset/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getPhoneNumber());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getUserId());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Asset();
        $fixture->setTitle('My Title');
        $fixture->setPhoneNumber('My Title');
        $fixture->setDescription('My Title');
        $fixture->setUserId('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/asset/');
    }
}
